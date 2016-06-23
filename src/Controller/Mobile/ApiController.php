<?php

namespace App\Controller\Mobile;

use App\Controller\Mobile\AppController;
use Wpadmin\Utils\UploadFile;

/**
 * Api Controller  用于app接口
 *
 * @property \App\Model\Table\ApiTable $Api
 *
 */
class ApiController extends AppController {

    const TOKEN = 'dBkuJtWzHuPJFtTjZqHJugGP';

    protected $noAcl = [
        'upload'
    ];

    public function initialize() {
        parent::initialize();
    }

    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        return $this->checkAcl();
    }

    protected function checkAcl() {
        \Cake\Log\Log::debug('接口debug');
        \Cake\Log\Log::debug($this->request->data());
        if (!$this->request->isPost()) {
            return $this->Util->ajaxReturn(false, '请求受限', 405);
        }
        if (!in_array(strtolower($this->request->param('action')), $this->noAcl)) {
            if (!$this->request->data('timestamp') || !$this->request->data('access_token')) {
                return $this->Util->ajaxReturn(false, '参数不正确', 412);
            }
            if (!$this->checkSign($this->request->data())) {
                return $this->Util->ajaxReturn(false, '验证不通过', 401);
            }
        } else {
            return $this->baseCheckAcl();
        }
    }

    protected function baseCheckAcl() {
        $timestamp = $this->request->data('timestamp');
        $access_token = $this->request->data('access_token');
        if (!$timestamp || !$access_token) {
            return $this->Util->ajaxReturn(false, '参数不正确', 412);
        }
        $timediff = time() - $timestamp;
        if ($timediff > 30 * 60) {
            return $this->Util->ajaxReturn(false, '时间参数过期', 408);
        }
        $sign = strtoupper(md5($timestamp . self::TOKEN));
        \Cake\Log\Log::debug($sign);
        if ($sign != $access_token) {
            return $this->Util->ajaxReturn(false, '验证不通过', 401);
        }
    }

    /**
     *  生成签名
     * @param type $params
     * @return type
     */
    protected function setSign($params) {
        ksort($params);
        $stringA = urldecode(http_build_query($params)); //不要转义的
        $stringB = $stringA . '&key=' . self::TOKEN;
        $sign = strtoupper(md5($stringB));
        return $sign;
    }

    protected function baseSign($time) {
        return strtoupper(md5($time . self::TOKEN));
    }

    public function test() {
        $this->Util->ajaxReturn(['access_token' => $this->setSign($this->request->data())]);
    }

    public function baseTest() {
        $time = time();
        return $this->Util->ajaxReturn(['access_token' => $this->baseSign($time), 'time' => $time]);
    }

    /**
     *  验证签名
     * @param type $params
     * @return type
     */
    protected function checkSign($params) {
        $access_token = $params['access_token'];
        unset($params['access_token']);
        ksort($params);
        $stringA = urldecode(http_build_query($params)); //不要转义的
        $stringB = $stringA . '&key=' . self::TOKEN;
        $sign = strtoupper(md5($stringB));
        return $access_token == $sign;
    }

    /**
     * 上传接口
     * @return type
     */
    public function upload() {
        $this->autoRender = false;
        $dir = 'app';
        $extra_data = $this->request->data('extra_param');
        $extra_data_json = json_decode($extra_data);
        if(is_object($extra_data_json)){
            if(isset($extra_data_json->dir)){
                $dir = $extra_data_json->dir;
            }
        }
        $today = date('Y-m-d');
        $urlpath = '/upload/' . $dir . '/' . $today . '/';
        $savePath = ROOT . '/webroot' . $urlpath;
        $upload = new UploadFile(); // 实例化上传类
        $upload->maxSize = 31457280; // 设置附件上传大小
        $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg', 'zip', 'ppt',
            'pptx', 'doc', 'docx', 'xls', 'xlsx', 'webp'); // 设置附件上传类型
        $upload->savePath = $savePath; // 设置附件上传目录
        if(isset($extra_data_json->zip)){
            if ($extra_data_json->zip) {
                //缩略图处理
                $upload->thumb = true;
                $upload->thumbMaxWidth = '60';
                $upload->thumbMaxHeight = '60';
            }
        }
        $upload->savePath = $savePath; // 设置附件上传目录
        if (!$upload->upload()) {// 上传错误提示错误信息
            $response['status'] = false;
            $response['msg'] = $upload->getErrorMsg();
        } else {// 上传成功 获取上传文件信息
            $info = $upload->getUploadFileInfo();
            $response['status'] = true;
            $response['path'] = $urlpath . $info[0]['savename'];
            $response['thumbpath'] = $urlpath . $upload->thumbPrefix . $info[0]['savename'];
            $response['msg'] = '上传成功!';
        }
        return $this->Util->ajaxReturn($response);
    }

}
