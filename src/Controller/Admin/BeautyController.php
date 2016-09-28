<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;
use Wpadmin\Utils\UploadFile;

/**
 * Beauty Controller
 *
 * @property \App\Model\Table\BeautyTable $Beauty
 */
class BeautyController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $votingType = \Cake\Core\Configure::read('votingType');
        $this->set([
            'beauty'=>$this->Beauty,
            'votingType' => $votingType,
        ]);
    }

    /**
     * View method
     *
     * @param string|null $id Beauty id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $beauty = $this->Beauty->get($id, [
            'contain' => ['Users', 'Votes']
        ]);
        $this->set('beauty', $beauty);
        $this->set('_serialize', ['beauty']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $beauty = $this->Beauty->newEntity();
        if ($this->request->is('post')) {
            $beauty = $this->Beauty->patchEntity($beauty, $this->request->data);
            if ($this->Beauty->save($beauty)) {
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $beauty->errors();
                $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }
        $users = $this->Beauty->Users->find('list', ['limit' => 200]);
        $this->set(compact('beauty', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Beauty id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $SavantTable = \Cake\ORM\TableRegistry::get('savant');
        $beauty = $this->Beauty->get($id, [
            'contain' => ['BeautyPics']
        ]);
        $savant = $SavantTable->find()->where(['user_id'=>$beauty->user_id])->first();
        if ($this->request->is(['post', 'put'])) {
            $beauty = $this->Beauty->patchEntity($beauty, $this->request->data);
            if(empty($savant)){
                $savant = $SavantTable->newEntity();
                $savant->user_id = $beauty->user_id;
            }
            $savant->xmjy = $this->request->data('xmjy');
            $res = $this->Beauty->connection()->transactional(function()use($beauty, $SavantTable, $savant){
                return $this->Beauty->save($beauty) && $SavantTable->save($savant);
            });
            if ($res) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $beauty->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $users = $this->Beauty->Users->find('list', ['limit' => 200]);
        $votintType = \Cake\Core\Configure::read('votingType');
        $this->set('votingType', $votintType);
        $this->set(compact('beauty', 'users', 'savant'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Beauty id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $beauty = $this->Beauty->get($id);
            if ($this->Beauty->delete($beauty)) {
                $this->Util->ajaxReturn(true, '删除成功');
            } else {
                $errors = $beauty->errors();
                $this->Util->ajaxReturn(true, getMessage($errors));
            }
        }
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
        $sort = 'Beauty.' . $this->request->data('sidx');
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $is_pass = $this->request->data('is_pass');
        $type_id = $this->request->data('type_id');
        $where = [];
        if (!empty($keywords)) {
            $where[' users.truename like'] = "%$keywords%";
        }
        if ($is_pass !== '' && $is_pass !== null) {
            $where['is_pass'] = $is_pass;
        }
        if (!empty($type_id)) {
            $where['type_id'] = $type_id;
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`create_time`) >' => $begin_time], ['date(`create_time`) <' => $end_time]];
        }
        $query = $this->Beauty->find()->contain(['Users', 'Votes']);
        $query->hydrate(false);
        if (!empty($where)) {
            $query->where($where);
        }
        $nums = $query->count();
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }

        $query->limit(intval($rows))
                ->page(intval($page));
        $res = $query->toArray();
        if (empty($res)) {
            $res = array();
        }
        if ($nums > 0) {
            $total_pages = ceil($nums / $rows);
        } else {
            $total_pages = 0;
        }
        $data = array('page' => $page, 'total' => $total_pages, 'records' => $nums, 'rows' => $res);
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
        $sort = $this->request->query('sidx');
        $order = $this->request->query('sord');
        $keywords = $this->request->query('keywords');
        $begin_time = $this->request->query('begin_time');
        $end_time = $this->request->query('end_time');
        $where = [];
        if (!empty($keywords)) {
            $where['username like'] = "%$keywords%";
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`create_time`) >' => $begin_time], ['date(`create_time`) <' => $end_time]];
        }
        $Table = $this->Beauty;
        $column = ['用户id', '票数', '星座', '个人简介', '参赛宣言', '兴趣爱好', '创建时间', '更新时间', '是否审核通过：0：未审核；1：审核通过；2：审核未通过'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['user_id', 'vote_nums', 'constellation', 'brief', 'declaration', 'hobby', 'create_time', 'update_time', 'is_pass']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = 'Beauty_' . date('Y-m-d') . '.csv';
        \Wpadmin\Utils\Export::exportCsv($column, $res, $filename);
    }

    public function check($id) {
        $beauty = $this->Beauty->get($id);
        if ($beauty->is_pass == 1) {
            $beauty->is_pass = 2;
        } else {
            $beauty->is_pass = 1;
        }
        $res = $this->Beauty->save($beauty);
        if ($res) {
            return $this->Util->ajaxReturn(true, '修改成功');
        } else {
            return $this->Util->ajaxReturn(false, '修改失败');
        }
    }

    public function delpic() {
        $id = $this->request->query('id');
        $PicTable = \Cake\ORM\TableRegistry::get('BeautyPic');
        $pic = $PicTable->get($id);
        if ($PicTable->delete($pic)) {
            return $this->Util->ajaxReturn(true, '删除成功');
        } else {
            return $this->Util->ajaxReturn(false, '删除失败');
        }
    }

    public function uploadpic($user_id) {
        $today = date('Y-m-d');
        $urlpath = '/upload/beauty/pic/' . $today . '/';
        $savePath = ROOT . '/webroot' . $urlpath;
        $upload = new UploadFile(); // 实例化上传类
        $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg', 'zip', 'ppt',
            'pptx', 'doc', 'docx', 'xls', 'xlsx', 'webp', 'rar', 'mp3', 'mp4', 'm4v', 'pdf'); // 设置附件上传类型
        //缩略图处理
        $upload->thumb = true;
        $upload->thumbMaxWidth = '60';
        $upload->thumbMaxHeight = '60';
        $upload->savePath = $savePath; // 设置附件上传目录
        if (!$upload->upload()) {// 上传错误提示错误信息
            $response['status'] = false;
            $response['msg'] = $upload->getErrorMsg();
        } else {// 上传成功 获取上传文件信息
            $info = $upload->getUploadFileInfo();
            $response['name'] = $info[0]['name'];
            $response['info'] = $info[0];
            $response['path'] = $urlpath . $info[0]['savename'];
            $response['smallpath'] = $urlpath .'small_'. $info[0]['savename'];
            $PicTable = \Cake\ORM\TableRegistry::get('BeautyPic');
            $pic = $PicTable->newEntity([
                'pic_url'=>$response['smallpath'],
                'user_id'=>$user_id
            ]);
            if($PicTable->save($pic)){
                $response['stauts'] = true;
                $response['msg'] = '上传成功!';
            }else{
                $response['stauts'] = false;
                $response['msg'] = '上传失败!';
            }
        }
        $this->Util->ajaxReturn($response);
    }

}
