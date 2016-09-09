<?php

namespace App\Controller\Mobile;

use App\Controller\Mobile\AppController;
use App\Utils\umeng\Umeng;
use Cake\Utility\Security;

/**
 * Index Controller
 *
 * @property \App\Model\Table\IndexTable $Index
 * @property \App\Controller\Component\SmsComponent $Sms
 * @property \App\Controller\Component\WxComponent $Wx
 * @property \App\Controller\Component\EncryptComponent $Encrypt
 * @property \App\Controller\Component\PushComponent $Push
 */
class IndexController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        //$umengObj = new Umeng($key, $secret);
        //var_dump($umengObj);

        $this->autoRender = false;
        //$res = \Cake\Cache\Cache::write('foo', 'bar', 'redis');
        //debug($res);
        debug(\Cake\Cache\Cache::read('foo', 'redis'));
        //$filename = WWW_ROOT.'/upload/user/avatar/test.jpg';
        //\Intervention\Image\ImageManagerStatic::make($filename)
                //->save('test.jpg',20);
//                $this->response->cookie([
//                            'name' => 'login_stauts',
//                            'value' => 'yes3',
//                            'path' => '/',
//                            'expire' => time() + 1200
//                        ]);
//        $redis = new \Redis();
//        $redis->connect('192.168.1.7', 6379);
//        $test = $redis->get('test');
//        //$UserTable = \Cake\ORM\TableRegistry::get('User');
//        //$users = $UserTable->find()->hydrate(false)->select(['phone'])->where(['is_del' => 0, 'enabled' => '1'])->toArray();
//        debug($redis->sGetMembers('phones'));
//        $res = $redis->sRemove('phones','1');
//        foreach ($users as $user){
//            $redis->sAdd('phones',$user['phone']);
//        }
        //debug($this->request);
//        $key = 'wt1U5MACWJFTXGenFoZoiLwQGrLgdbHA';
//        debug(Security::hash(uniqid()),'sha1',true);
//        $result = Security::encrypt('123', $key);
//        $cipher = base64_encode($result);
//        debug(Security::decrypt(base64_decode($cipher), $key));
//        $this->loadComponent('Wx');
//        $access_token = $this->Wx->getAccessToken();
//        var_dump($access_token);exit();
//        $httpClient = new \Cake\Network\Http\Client(['ssl_verify_peer' => false]);
//        $res = $httpClient->post('http://bgq.dev/api/wxtoken');
        //debug($res);
        //$token = 'QZeqKxItfF2jXWdIWjePlhBEX3JK9JKtIJkCwYMisw8c8Raqg2iOIWufshlgswB04Mj0d8mnmu3uuDUtqsbP51W0AOsyLWx1lhkWPA0Svcy60eLZmTiHKWEA-BXiOdDaDKThAEANUD';
//        $token = 'MjQMDc3YWZkMTk0NzJmYTc3NjI1MWU2ZDA1NWI5ZmI4Y2VjMTYxNjcxYTA4MGY4NzFjNTU3ZWQ0YWIwNTkwNAQ5bXSGZ1tx/Q1EuasSyLB4rrFnzYlobxSDbeTJu0PPt3EPsv1FgvYet/jDx1ItuasQCBOMma7lG7ZskFHSBL7epml/ox0l5Gt0GqQ+3Ef21qvC1UzCHAWr0mB+E5f0wYY51pcY0H/gMe2BrY5C0XeX5jC+PnilQ/DfvcrsQ1ypVzCsnkRiVH3kkagRtFUyriYco7S3zjhiBHUQL0a3FVw=';
//        $this->loadComponent('Encrypt');
        //$en_str = $this->Encrypt->encrypt('123');
        //var_dump($en_str);
//        $key = 'fkc33fdsafasdfasdfasdfasdgasddklsjfasdklfjasdkljaskljgklasdjgaekljgkl';
//        $en_str = Security::encrypt('123', $key,'1');
//        debug(Security::decrypt($en_str, $key,'1'));
//        debug(Security::hash(uniqid(),'md5'));
//        $this->loadComponent('Push');
//        $this->Push->test();
//        
//        var_dump(1/100);
        //$en_token = $this->Encrypt->encrypt($token);
        //debug($en_token);
        //debug($this->Encrypt->decrypt($en_str));
//        $xml = \Cake\Utility\Xml::build([
//                    'return_code' => 'SUCCESS',
//                    'return_msg' => 'OK',
//        ]);
//        debug($xml);
        $arr = ['foo' => 'bar', 'you' => 'done'];
        $this->Util->dblog('order', '一个测试日志', $arr);
        $arr = 'testnkad';
        echo var_export($arr, true);
    }

    public function test() {
        $this->autoRender = false;
        $cipher = 'NDk3MzYyNmI3YzI0YjMwZDU4MTViZTliOTVhNGRlYzZhOTk3ZmZlZmQwNmNlOTI1NjExODU1ZDAwNTJiMzEwZaD0xBasVESkYgXn99ZSMnBRdwanx0YcQse1r6cbGC1Z';
        $this->loadComponent('Encrypt');
        $str = $this->Encrypt->decrypt($cipher);
        debug($str);
    }

    public function setphone() {
        $this->autoRender = false;
        $redis = new \Redis();
        $redis_conf = \Cake\Core\Configure::read('redis_server');
        $redis->connect($redis_conf['host'], $redis_conf['port']);
        $UserTable = \Cake\ORM\TableRegistry::get('User');
        $users = $UserTable->find()->hydrate(false)->select(['phone'])->where(['is_del' => 0, 'enabled' => '1'])->toArray();
        foreach ($users as $user) {
            if (empty($user['phone'])) {
                continue;
            }
            $redis->sAdd('phones', $user['phone']);
        }
        debug($redis->sGetMembers('phones'));
    }

}
