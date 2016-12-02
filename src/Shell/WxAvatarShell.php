<?php

namespace App\Shell;

use Cake\Console\Shell;

/**
 * Pvlog shell command.
 */
class WxAvatarShell extends Shell {

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

    public function run() {
        set_time_limit(0);
        $UserTable = \Cake\ORM\TableRegistry::get('User');
        $redis = new \Redis();
        $redis_conf = \Cake\Core\Configure::read('redis_server');
        $redis->connect($redis_conf['host'], $redis_conf['port']);
        $size = $redis->lSize('bgq_avatar_queue');
        $records = $redis->lrange('bgq_avatar_queue', 0, $size - 1);
        foreach ($records as $k=>$v) {
            $user = $UserTable->get($v);
            if(strpos($user->avatar, 'http:')){
                $today = date('Y-m-d');
                $path = 'upload/user/avatar/'.$today;
                $uniqid = uniqid();
                $file_name = $path.'/thumb_' . $uniqid.'.jpg';
                if(!is_dir($path)){
                    mkdir($path,0777,true);
                }
                \Intervention\Image\ImageManagerStatic::make($this->request->session()->read('reg.avatar'))
                                ->save($path.'/'.$uniqid.'.jpg');
                $img = \Intervention\Image\ImageManagerStatic::make($path.'/'.$uniqid.'.jpg');
                $info = $img->exif();
        //        \Cake\Log\Log::debug($info,'devlog');
                $image = $info['COMPUTED'];
                \Intervention\Image\ImageManagerStatic::make($path.'/'.$uniqid.'.jpg')
                        ->resize(intval($image['Width']*0.4), intval($image['Height']*0.4))
                        ->save($path .'/small_' .$uniqid . '.jpg');
                \Intervention\Image\ImageManagerStatic::make($path.'/'.$uniqid.'.jpg')
                        ->resize(60,60)
                        ->save($file_name);
                $user->avatar = '/' . $path . '/' . $file_name;
                $res = $UserTable->save($user);
                if(!$res){
                  //出错报警 出错处理
                  dblog('user', '微信头像保存失败，用户id为：'.$v.',原因为：'.$user->errors());
                  \Cake\Log\Log::error('bgq_avatar_queue 保存失败','cron');
                }
            }
            //插入成功则 删除掉已保存 队列元素
            $redis->lrem('bgq_avatar_queue', $v, 0);
        }
    }

}
