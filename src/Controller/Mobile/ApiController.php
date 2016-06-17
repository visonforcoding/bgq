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
        $this->checkAcl();
    }

    protected function checkAcl() {
        if (!$this->request->isPost()) {
            $this->Util->ajaxReturn(false, '请求受限', 405);
        }
        if (!in_array(strtolower($this->request->param('action')), $this->noAcl)) {
            if (!$this->request->data('timestamp') || !$this->request->data('access_token')) {
                $this->Util->ajaxReturn(false, '参数不正确', 412);
            }
            if (!$this->checkSign($this->request->data())) {
                $this->Util->ajaxReturn(false, '验证不通过', 401);
            }
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

    public function test() {
        $this->Util->ajaxReturn(['access_token' => $this->setSign($this->request->data())]);
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

    public function upload() {
        $this->autoRender = false;
        $dir = 'app';
        $today = date('Y-m-d');
        $urlpath = '/upload/' . $dir . '/' . $today . '/';
        $savePath = ROOT . '/webroot' . $urlpath;
        $upload = new UploadFile(); // 实例化上传类
        $upload->maxSize = 31457280; // 设置附件上传大小
        $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg', 'zip', 'ppt',
            'pptx', 'doc', 'docx', 'xls', 'xlsx', 'webp'); // 设置附件上传类型
        $upload->savePath = $savePath; // 设置附件上传目录
        if (!$upload->upload()) {// 上传错误提示错误信息
            $response['status'] = false;
            $response['msg'] = $upload->getErrorMsg();
        } else {// 上传成功 获取上传文件信息
            $info = $upload->getUploadFileInfo();
            $response['status'] = true;
            $response['path'] = $urlpath . $info[0]['savename'];
            $response['msg'] = '上传成功!';
        }
        $this->Util->ajaxReturn($response);
    }

}
