<?php

namespace App\Shell;

use Cake\Console\Shell;

/**
 * Pvlog shell command.
 */
class PvlogShell extends Shell {

    /**
     * Manage the available sub-commands along with their arguments and help
     *
     * @see http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser() {
        $parser = parent::getOptionParser();

        return $parser;
    }

    /**
     * main() method.
     *
     * @return bool|int Success or error code.
     */
    public function main() {
        $this->out($this->OptionParser->help());
    }

    public function pvsave() {
        \Cake\Log\Log::notice('进入pvlog shell pvsave', 'cron');
        $datas = [];
        $redis = new \Redis();
        $redis_conf = \Cake\Core\Configure::read('redis_server');
//        $redis->connect('192.168.1.7', $redis_conf['port']);
        $redis->connect($redis_conf['host'], $redis_conf['port']);
        $size = $redis->lSize('pvlog');
        $records = $redis->lrange('pvlog', 0, $size - 1);
        foreach ($records as $record) {
            $datas[] = unserialize($record);
        }
        if ($datas) {
           $PvlogTable = \Cake\ORM\TableRegistry::get('Pvlog');
            $query = $PvlogTable->query()->insert(['screen', 'refer', 'act', 'ptag', 'ip', 'url', 'urlmap', 'user_id',
                'is_app', 'os', 'os_version', 'useragent', 'create_time']);
            foreach ($datas as $k => $value) {
                $query->values($value);
            }
            $ins = $query->execute();
            if ($ins) {
                //插入成功则 删除掉已保存 队列元素
                $redis->ltrim('pvlog', $size, -1);
                \Cake\Log\Log::notice('pvlog shell pvsave 保存了'.$size.'条记录','cron');
            } else {
                //出错 警报
                \Cake\Log\Log::error('pvlog shell pvsave 保存失败','cron');
            }
        }
    }

}
