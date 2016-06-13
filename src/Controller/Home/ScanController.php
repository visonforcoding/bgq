<?php

namespace App\Controller\Mobile;

use App\Controller\Mobile\AppController;

class ScanController extends AppController {

    /**
     * 首页
     */
    public function index() {
        $guid = $this->create_guid();
        $code = $this->create_qrcode($guid);
        $this->set('code', $code);
    }

    /**
     * 二维码的链接，带全局唯一标识
     * @param string $guid
     */
    public function scanLogin($guid) {
        $userTable = \Cake\ORM\TableRegistry::get('User');
        $userTable->get();
    }
    
    /**
     * 轮询是否授权了
     * @param string $guid
     * @return boolean
     */
    public function check($guid){
        $userTable = \Cake\ORM\TableRegistry::get('User');
        $user = $userTable->find()->where('guid='.$guid)->toArray();
        if($user != false)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    /**
     * 授权登录
     * @param int $id
     * @param string $guid
     * @return boolean
     */
    public function login($id, $guid){
        $userTable = \Cake\ORM\TableRegistry::get('User');
        $user = $userTable->get($id);
        $user->guid = $guid;
        $res = $userTable->save();
        if($res)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * 生成guid，全局唯一标识
     * @return string
     */
    public function create_guid() {
        $charid = strtoupper(md5(uniqid(mt_rand(), true)));
        $hyphen = chr(45);
        $uuid = substr($charid, 6, 2) . substr($charid, 4, 2) . substr($charid, 2, 2) . substr($charid, 0, 2) . $hyphen . substr($charid, 10, 2) . substr($charid, 8, 2) . $hyphen . substr($charid, 14, 2) . substr($charid, 12, 2) . $hyphen . substr($charid, 16, 4) . $hyphen . substr($charid, 20, 12);
        return $uuid;
    }
    
    public function create_qrcode($guid){
        require_once(ROOT . DS . 'vendor' . DS  . 'phpqrcode' . DS . 'phpqrcode.php');
        $qrcode = new \QRcode();
        $text = 'http://' . $_SERVER['SERVER_NAME'] . '/scan/scanLogin/' . $guid; //二维码内容
        $url = 'upload/qrcode/'. $guid .'.png'; //二维码路径
        $level = 'L'; //容错级别   
        $size = 6; //生成图片大小   
        $qrcode->png($text, $url, $level, $size, 2);
        return $url;
    }

}
