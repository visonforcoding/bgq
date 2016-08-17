<?php

namespace App\Controller\Home;

use App\Controller\Home\AppController;
use Cake\Mailer\Email;

/**
 * User Controller
 *
 * @property \App\Model\Table\UserTable $User
 * @property \App\Controller\Component\HanvonComponent $Hanvon
 * @property \App\Controller\Component\SmsComponent $Sms
 * @property \App\Controller\Component\BusinessComponent $Business
 * @property \App\Controller\Component\WxComponent $Wx
 */
class UserController extends AppController {
    
    /**
     * 登录
     */
    public function login(){
        $guid = $this->create_guid();
        $code = $this->create_qrcode($guid);
        $this->set([
            'pageTitle'=>'登录',
            'code' => $code,
            'guid' => $guid,
        ]);
    }
    
    /**
     * 二维码的链接，带全局唯一标识
     * @param string $guid
     */
    public function scanLogin($guid) {
        if($this->user){
            $user_id = $this->user->id;
            $user = $this->User->get($user_id);
            $user->guid = $guid;
            $res = $this->User->save($user);
            if($res){
                $this->set('res', '授权成功');
            } else {
                $this->set('res', '授权失败');
            }
        } else {
            $this->redirect('/home/index');
        }
        $this->set([
            'pageTitle'=>'扫码登录',
        ]);
    }
    
    /**
     * 轮询是否授权了
     * @param string $guid
     * @return boolean
     */
    public function check($guid){
        $user = $this->User->find()->where(['guid'=>$guid])->first();
        if ($user != false) {
            $user = $this->request->session()->write('User.mobile', $user);
            return $this->Util->ajaxReturn(true, '登录成功');
        } else {
            return $this->Util->ajaxReturn(false, '登录失败');
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
        $text = 'http://' . $_SERVER['SERVER_NAME'] . '/w/user/scanLogin/' . $guid; //二维码内容
        $url = 'upload/qrcode/logincode/'. $guid .'.png'; //二维码路径
        $level = 'L'; //容错级别
        $size = 6; //生成图片大小
        \PHPQRCode\QRcode::png($text, $url, $level, $size, 2);
        return $url;
    }
}