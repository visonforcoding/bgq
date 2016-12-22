<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Class Controller
 *
 * @property \App\Model\Table\ClassTable $Class
 */
class ClassController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index($id=null) {
        $this->set([
            'class'=>$this->Class,
            'id' => $id
        ]);
    }

    /**
     * View method
     *
     * @param string|null $id Clas id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $clas = $this->Class->get($id, [
            'contain' => ['Mentors', 'Courses']
        ]);
        $this->set('clas', $clas);
        $this->set('_serialize', ['clas']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add($course_id=null) {
        $clas = $this->Class->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $clas = $this->Class->patchEntity($clas, $data);
            $clas->course_id = $course_id;
            $res = $this->Class->save($clas);
            if ($res) {
                if($res->zip) {
                    $is_success = $this->uncompress($res->zip, $res->id);
                    if(!$is_success){
                        return $this->Util->ajaxReturn(false, '解压缩失败');
                    }
                }
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $clas->errors();
                $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }
        $mentors = $this->Class->Mentors->find('list', ['limit' => 200]);
        $courses = $this->Class->Courses->find('list', ['limit' => 200]);
        $this->set(compact('clas', 'mentors', 'courses', 'course_id'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Clas id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $clas = $this->Class->get($id, [
            'contain' => []
        ]);
        $old = $clas->zip;
        if ($this->request->is(['post', 'put'])) {
            $class = $this->Class->patchEntity($clas, $this->request->data);
            $res = $this->Class->save($class);
            if ($res) {
                if($old != $res->zip){
                    $is_success = $this->uncompress($res->zip, $id);
                    if(!$is_success){
                        return $this->Util->ajaxReturn(false, '解压缩失败');
                    }
                }
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $class->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $mentors = $this->Class->Mentors->find('list', ['limit' => 200]);
        $courses = $this->Class->Courses->find('list', ['limit' => 200]);
        $this->set(compact('clas', 'mentors', 'courses'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Clas id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $clas = $this->Class->get($id);
            $clas->is_del = 1;
            if ($this->Class->save($clas)) {
                $this->Util->ajaxReturn(true, '删除成功');
            } else {
                $errors = $clas->errors();
                $this->Util->ajaxReturn(true, getMessage($errors));
            }
        }
    }

    /**
     * get jqgrid data 
     *
     * @return json
     */
    public function getDataList($id=null) {
        $this->request->allowMethod('ajax');
        $page = $this->request->data('page');
        $rows = $this->request->data('rows');
        $sort = 'Class.' . $this->request->data('sidx');
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $where = [];
        $where['Class.is_del'] = 0;
        if (!empty($keywords)) {
            $where['or'] = [
                'Class.title like' => "%$keywords%",
                'Class.abstract like' => "%$keywords%",
            ];
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['Class.create_time >' => $begin_time], ['Class.create_time <' => $end_time]];
        }
        $query = $this->Class->find();
        $query->hydrate(false);
        if (!empty($where)) {
            $query->where($where);
        }
        $query->contain(['Mentors'=>function($q){
            return $q->where(['Mentors.is_del'=>0]);
        }, 'Courses'=>function($q){
            return $q->where(['Courses.is_del'=>0]);
        }]);
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
        $Table = $this->Class;
        $column = ['导师id', '培训id', '课程标题', '课程介绍', '音频', '课程ppt/pdf路径', '是否免费', '创建时间', '更新时间'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['mentor_id', 'course_id', 'title', 'abstract', 'audio', 'pdf', 'is_free', 'create_time', 'update_time']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = 'Class_' . date('Y-m-d') . '.csv';
        \Wpadmin\Utils\Export::exportCsv($column, $res, $filename);
    }
    
    public function change($id=null){
        if($this->request->is('post')){
            $class = $this->Class->get($id);
            $class->is_free = $class->is_free ? 0 : 1;
            $res = $this->Class->save($class);
            if($res){
                return $this->Util->ajaxReturn(true, '修改成功');
            } else {
                return $this->Util->ajaxReturn(false, getMessage($class->errors()));
            }
        }
    }
    
    /**
     * 解压缩
     * @param type $url 压缩包地址
     * @param type $id 课程id
     */
    public function uncompress($url, $id){
        $zip = new \ZipArchive();
        if($zip->open(WWW_ROOT . $url)){
            $url = '/upload/class/pic/' . uniqid() . '-' . $id;
            if(mkdir(WWW_ROOT . '/' . $url)){
                $zip->extractTo(WWW_ROOT . '/' . $url);
                $zip->close();
                $file = scandir(WWW_ROOT . '/' . $url);
                foreach($file as $k=>$v){
                    if(strpos(strtolower($v), '.jpg') === false){
                        unset($file[$k]);
                    }
                }
//                unset($file[0]);
//                unset($file[1]);
                $file = array_values($file);
                $ClassPicTable = \Cake\ORM\TableRegistry::get('ClassPic');
                $is_exist = $ClassPicTable->find()->where(['class_id'=>$id])->toArray();
                if($is_exist){
                    $ClassPicTable->query()->delete()->where(['class_id'=>$id])->execute();
                }
                $data = [];
                foreach($file as $k=>$v){
                    $data[$k]['class_id'] = $id;
                    $data[$k]['pic'] = $url . '/' . $v;
                    $data[$k]['sort'] = str_replace(strstr($v, '.'), '', $v);
                }
                $pics = $ClassPicTable->newEntities($data);
                $res = $ClassPicTable->saveMany($pics);
                if($res){
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    public function test(){
        $a = scandir(WWW_ROOT . 'upload/beauty');
        unset($a[0]);
        unset($a[1]);
        $a = array_values($a);
        $b = str_replace(strstr($a[0], '.'), '', $a[0]);
        debug($b);die;
    }

}
