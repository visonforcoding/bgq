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
        $query = $this->Beauty->find()->contain(['Users'=>function($q){
            return $q->where(['enabled'=>1]);
        }, 'Votes']);
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
            $where['User.truename like'] = "%$keywords%";
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`create_time`) >' => $begin_time], ['date(`create_time`) <' => $end_time]];
        }
        $Table = $this->Beauty;
        $column = ['姓名', '手机', '职位', '公司', '个人简介', '申请时间', '审核状态'];
        $query = $Table->find()->contain(['Users']);
        $query->hydrate(false);
        $query->select(['user_id', 'Users.truename', 'Users.phone', 'Users.position', 'Users.company', 'brief', 'create_time', 'is_pass']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $arr = [];
        foreach ($res as $k=>$v){
            $arr[$k]['user_name'] = $v['user']['truename'];
            $arr[$k]['user_phone'] = $v['user']['phone'];
            $arr[$k]['user_position'] = $v['user']['position'];
            $arr[$k]['user_company'] = $v['user']['company'];
            $arr[$k]['brief'] = $v['brief'];
            $arr[$k]['create_time'] = $v['create_time']->format('Y-m-d H:i');
            switch ($v['is_pass']){
                case 0:
                    $arr[$k]['is_pass'] = '未审核';
                    break;
                case 1:
                    $arr[$k]['is_pass'] = '审核通过';
                    break;
                case 2:
                    $arr[$k]['is_pass'] = '审核未通过';
                    break;
            }
        }
        $this->autoRender = false;
        $filename = '菁英评选活动_' . date('Y-m-d') . '.xlsx';
        $this->loadComponent('Export');
        $this->Export->phpexcelExport($filename, $column, $arr);
    }
    
    public function export(){
        $sort = $this->request->query('sidx');
        $order = $this->request->query('sord');
        $keywords = $this->request->query('keywords');
        $begin_time = $this->request->query('begin_time');
        $end_time = $this->request->query('end_time');
        $where = [];
        $where['is_pass'] = 1;
        if (!empty($keywords)) {
            $where['User.truename like'] = "%$keywords%";
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`create_time`) >' => $begin_time], ['date(`create_time`) <' => $end_time]];
        }
        $Table = $this->Beauty;
        $column = ['姓名', '公司', '职位', '票数', '参选类型', '参选宣言', '兴趣爱好', '个人简介', '项目经验'];
        $query = $Table->find()->contain(['Users', 'Users.Savants']);
        $query->hydrate(false);
        $query->select(['user_id', 'Users.truename', 'Users.position', 'Users.company', 'vote_nums', 'type_id', 'declaration', 'hobby', 'brief', 'Savants.xmjy', 'is_pass']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $arr = [];
        $type = \Cake\Core\Configure::read('votingType');
        foreach ($res as $k=>$v){
            $arr[$k]['user_name'] = $v['user']['truename'];
            $arr[$k]['user_company'] = $v['user']['company'];
            $arr[$k]['user_position'] = $v['user']['position'];
            $arr[$k]['vote_nums'] = $v['vote_nums'];
            $arr[$k]['type'] = $type[$v['type_id']];
            $arr[$k]['declaration'] = $v['declaration'];
            $arr[$k]['hobby'] = $v['hobby'];
            $arr[$k]['brief'] = $v['brief'];
            $arr[$k]['xmjy'] = $v['user']['savant']['xmjy'];
        }
        $this->autoRender = false;
        $filename = '菁英评选活动_' . date('Y-m-d') . '.xlsx';
        $this->loadComponent('Export');
        $this->Export->phpexcelExport($filename, $column, $arr);
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
        $PicTable = \Cake\ORM\TableRegistry::get('BeautyPic');
        $counts = $PicTable->find()->where(['user_id'=>$user_id])->count();
        if($counts>=6){
            return $this->Util->ajaxReturn(false,'最多上传6张');
        }
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
            $response['path'] = $urlpath . $info[0]['savename'];
            $response['smallpath'] = $urlpath .'small_'. $info[0]['savename'];
            $pic = $PicTable->newEntity([
                'pic_url'=>$response['smallpath'],
                'user_id'=>$user_id
            ]);
            if($PicTable->save($pic)){
                $response['status'] = true;
                $response['msg'] = '上传成功!';
            }else{
                $response['status'] = false;
                $response['msg'] = '上传失败!';
            }
        }
        $this->Util->ajaxReturn($response);
    }
    
    /**
     * 导出投票数据
     */
    public function getVote(){
        $VoteTable = \Cake\ORM\TableRegistry::get('vote');
        $vote = $VoteTable->find()->contain(['Users', 'VoteUsers'])->hydrate(false)->toArray();
        $res = [];
        foreach($vote as $k=>$v){
            $res[$k]['id'] = $v['id'];
            $res[$k]['user'] = $v['user']['truename'];
            $res[$k]['vote_user'] = $v['vote_user']['truename'];
            $res[$k]['time'] = $v['create_time']->format('Y-m-d H:i:s');
        }
        $column = ['id', '投票人', '被投票人', '投票时间'];
        $this->autoRender = false;
        $filename = '投票记录_' . date('Y-m-d') . '.xlsx';
        $this->loadComponent('Export');
        $this->Export->phpexcelExport($filename, $column, $res);
    }
    

}
