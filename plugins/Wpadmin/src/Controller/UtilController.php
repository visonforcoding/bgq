<?php

namespace Wpadmin\Controller;

use Wpadmin\Controller\AppController;
use Wpadmin\Utils\UploadFile;
/**
 * Util Controller
 * 图标获取、处理上传
 * 
 */
class UtilController extends AppController {

    public function icon() {
        $iconFile = \Cake\Core\Plugin::path('Wpadmin') . '/config/icons.json';
        $iconJson = file_get_contents($iconFile);
        $iconArr = json_decode($iconJson, true);
        $this->viewBuilder()->autoLayout(false);
        $this->set('iconArr', $iconArr);
    }

    public function doUpload() {
        set_time_limit(0);
        $dir = $this->request->query('dir');
        $today = date('Y-m-d');
        $urlpath =  '/upload/tmp/' . $today . '/';
        if(!empty($dir)){
            $urlpath = '/upload/'.$dir.'/' . $today . '/';
        }
        $savePath = ROOT.'/webroot'.$urlpath;
        $upload = new UploadFile(); // 实例化上传类
        $upload->maxSize = 31457280; // 设置附件上传大小
        $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg','zip','ppt',
            'pptx','doc','docx','xls','xlsx','webp','rar','mp3','mp4','m4v'); // 设置附件上传类型
        if($this->request->query('zip')){
            //缩略图处理
            $upload->thumb = true;
            $upload->thumbMaxWidth = '60';
            $upload->thumbMaxHeight = '60';
        }
        $upload->savePath = $savePath; // 设置附件上传目录
        if (!$upload->upload()) {// 上传错误提示错误信息
            $response['status'] = false;
            $response['msg'] = $upload->getErrorMsg();
        } else {// 上传成功 获取上传文件信息
            $info = $upload->getUploadFileInfo();
            $response['status'] = true;
            $response['path'] = $urlpath . $info[0]['savename'];
            $response['thumbpath'] = $urlpath . $upload->thumbPrefix.$info[0]['savename'];
            $response['msg'] = '上传成功!';
        }
        $this->Util->ajaxReturn($response);
    }

}
