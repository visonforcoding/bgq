<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * CardBox Controller
 *
 * @property \App\Model\Table\CardBoxTable $CardBox
 */
class CardBoxController extends AppController {
    
    public function initialize() {
        parent::initialize();
        $this->loadModel('CardBox');
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->set('cardBox', $this->CardBox);
    }

    /**
     * View method
     *
     * @param string|null $id Card Box id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $cardBox = $this->CardBox->get($id, [
            'contain' => ['OtherCard', 'MyCardCase']
        ]);
        $this->set('cardBox', $cardBox);
        $this->set('_serialize', ['cardBox']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $cardBox = $this->CardBox->newEntity();
        if ($this->request->is('post')) {
            $cardBox = $this->CardBox->patchEntity($cardBox, $this->request->data);
            if ($this->CardBox->save($cardBox)) {
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $cardBox->errors();
                $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }
        $otherCard = $this->CardBox->OtherCard->find('list', ['limit' => 200]);
        $myCardCase = $this->CardBox->MyCardCase->find('list', ['limit' => 200]);
        $this->set(compact('cardBox', 'otherCard', 'myCardCase'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Card Box id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $cardBox = $this->CardBox->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['post', 'put'])) {
            $cardBox = $this->CardBox->patchEntity($cardBox, $this->request->data);
            if ($this->CardBox->save($cardBox)) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $cardBox->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $otherCard = $this->CardBox->OtherCard->find('list', ['limit' => 200]);
        $myCardCase = $this->CardBox->MyCardCase->find('list', ['limit' => 200]);
        $this->set(compact('cardBox', 'otherCard', 'myCardCase'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Card Box id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $cardBox = $this->CardBox->get($id);
            if ($this->CardBox->delete($cardBox)) {
                $this->Util->ajaxReturn(true, '删除成功');
            } else {
                $errors = $cardBox->errors();
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
        $sort = 'CardBox.' . $this->request->data('sidx');
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $reorder = $this->request->data('reorder');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $where = [];
        if (!empty($keywords) || !empty($reorder)) {
            $where['OR'] = [
//                ['OtherCard.`truename` like' => "%$keywords%"],
                ['MyCardCase.`truename` like' => "%$keywords%"],
                ['resend' => $reorder],
            ];
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['CardBox.`create_time` >' => $begin_time], ['CardBox.`create_time` <' => $end_time]];
        }
        $query = $this->CardBox->find()->contain(['OtherCard', 'MyCardCase']);
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
        $Table = $this->CardBox;
        $column = ['名片夹主人', '递名片用户', '是否回赠', '创建时间'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['ownerid', 'uid', 'resend', 'create_time']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = 'CardBox_' . date('Y-m-d') . '.csv';
        \Wpadmin\Utils\Export::exportCsv($column, $res, $filename);
    }

}
