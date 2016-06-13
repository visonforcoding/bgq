<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;
use Wpadmin\Utils\UploadFile;
use Cake\ORM\TableRegistry;

/**
 * Banner Controller
 *
 * @property \App\Model\Table\BannerTable $Banner
 */
class BannerController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $types = \Cake\Core\Configure::read('bannerTypes');
        $this->set('types', $types);
        $this->set('banner', $this->Banner);
    }

    /**
     * View method
     *
     * @param string|null $id Banner id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $banner = $this->Banner->get($id, [
            'contain' => []
        ]);
        $this->set('banner', $banner);
        $this->set('_serialize', ['banner']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $banner = $this->Banner->newEntity();
        if ($this->request->is('post')) {
            $this->autoRender = false;
            $this->response->type('json');
            $banner = $this->Banner->patchEntity($banner, $this->request->data);
            $banner->create_time = date('Y-m-d H:i:s');
            if ($this->Banner->save($banner)) {
                echo json_encode(array('status' => true, 'msg' => '添加成功'));
            } else {
                $errors = $banner->errors();
                echo json_encode(array('status' => false, 'msg' => getMessage($errors), 'errors' => $errors));
            }
            return;
        }
        $types = \Cake\Core\Configure::read('bannerTypes');
        $this->set(array(
            'types' => $types,
            'banner'=>$banner
        ));
    }

    /**
     * Edit method
     *
     * @param string|null $id Banner id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $banner = $this->Banner->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['post', 'put'])) {
            $this->autoRender = false;
            $this->response->type('json');
            $banner = $this->Banner->patchEntity($banner, $this->request->data);
            if ($this->Banner->save($banner)) {
                echo json_encode(array('status' => true, 'msg' => '修改成功'));
            } else {
                $errors = $banner->errors();
                echo json_encode(array('status' => false, 'msg' => getMessage($errors)));
            }
            return;
        }
        $this->set(compact('banner'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Banner id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $this->autoRender = false;
            $this->response->type('json');
            $banner = $this->Banner->get($id);
            if ($this->Banner->delete($banner)) {
                echo json_encode(array('status' => true, 'msg' => '删除成功'));
            } else {
                $errors = $banner->errors();
                echo json_encode(array('status' => false, 'msg' => getMessage($errors)));
            }
        }
        return;
    }

    /**
     * get jqgrid data 
     *
     * @return json
     */
    public function getDataList() {
        $this->request->allowMethod('ajax');
        $page = $this->request->data('page');
        $rows = $this->request->data('rows');
        $sort = $this->request->data('sidx');
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $type = $this->request->data('type');
        $where = [];
        if(!empty($type))
        {
            $where['type'] = $type;
        }
        if (!empty($keywords)) {
            $where['remark like'] = "%$keywords%";
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`create_time`) >' => $begin_time], ['date(`create_time`) <' => $end_time]];
        }
        $data = $this->getJsonForJqrid($page, $rows, '', $sort, $order, $where);
        $this->autoRender = false;
        $this->response->type('json');
        echo json_encode($data);
    }

    /**
     * export csv
     *
     * @return csv 
     */
    public function exportExcel() {
        $sort = $this->request->data('sidx');
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $where = [];
        if (!empty($keywords)) {
            $where[' username like'] = "%$keywords%";
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`ctime`) >' => $begin_time], ['date(`ctime`) <' => $end_time]];
        }
        $Table = $this->Banner;
        $column = ['类型', '图片', '链接地址', '备注说明', '创建时间'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['type', 'img', 'url', 'remark', 'create_time']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = 'Banner_' . date('Y-m-d') . '.csv';
        \Wpadmin\Utils\Export::exportCsv($column, $res, $filename);
    }

    public function uploadImg() {
        $today = date('Y-m-d');
        $recode_path = '/upload/banner/' . $today . '/'; //数据库中记录的路径
        $urlpath = ROOT . '/webroot/upload/banner/' . $today . '/';
        $savePath = $urlpath;
        $upload = new UploadFile(); // 实例化上传类
        $upload->maxSize = 31457280; // 设置附件上传大小
        $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型
        $upload->savePath = $savePath; // 设置附件上传目录
        if (!$upload->upload()) {// 上传错误提示错误信息
            $response['status'] = false;
            $response['msg'] = $upload->getErrorMsg();
        } else {// 上传成功 获取上传文件信息
            $info = $upload->getUploadFileInfo();
            $response['status'] = true;
            $response['path'] = $urlpath . $info[0]['savename'];
            $response['record_path'] = $recode_path . $info[0]['savename'];
            $response['msg'] = '上传成功!';
        }
        $this->autoRender = false;
        $this->response->type('json');
        echo json_encode($response);
    }

    public function doUpload() {
        $dir = $this->request->query('dir');
        $today = date('Y-m-d');
        $urlpath = '/upload/tmp/' . $today . '/';
        if (!empty($dir)) {
            $urlpath = '/upload/banner/' . $today . '/';
        }
        $savePath = ROOT . '/webroot' . $urlpath;
        ;
        $upload = new UploadFile(); // 实例化上传类
        $upload->maxSize = 31457280; // 设置附件上传大小
        $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型
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
