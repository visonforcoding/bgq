<?php
namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Profiletag Controller
 *
 * @property \App\Model\Table\ProfiletagTable $Profiletag
 */
class ProfiletagController extends AppController
{

/**
* Index method
*
* @return void
*/
public function index()
{
$this->set('profiletag', $this->Profiletag);
}

    /**
     * View method
     *
     * @param string|null $id Profiletag id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->autoLayout(false);
        $profiletag = $this->Profiletag->get($id, [
            'contain' => []
        ]);
        $this->set('profiletag', $profiletag);
        $this->set('_serialize', ['profiletag']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $profiletag = $this->Profiletag->newEntity();
        if ($this->request->is('post')) {
            $profiletag = $this->Profiletag->patchEntity($profiletag, $this->request->data);
            if ($this->Profiletag->save($profiletag)) {
                 $this->Util->ajaxReturn(true,'添加成功');
            } else {
                 $errors = $profiletag->errors();
                 $this->Util->ajaxReturn(['status'=>false, 'msg'=>getMessage($errors),'errors'=>$errors]);
            }
        }
                $this->set(compact('profiletag'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Profiletag id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
         $profiletag = $this->Profiletag->get($id,[
            'contain' => []
        ]);
        if ($this->request->is(['post','put'])) {
            $profiletag = $this->Profiletag->patchEntity($profiletag, $this->request->data);
            if ($this->Profiletag->save($profiletag)) {
                  $this->Util->ajaxReturn(true,'修改成功');
            } else {
                 $errors = $profiletag->errors();
               $this->Util->ajaxReturn(false,getMessage($errors));
            }
        }
                  $this->set(compact('profiletag'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Profiletag id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod('post');
         $id = $this->request->data('id');
                if ($this->request->is('post')) {
                $profiletag = $this->Profiletag->get($id);
                 if ($this->Profiletag->delete($profiletag)) {
                     $this->Util->ajaxReturn(true,'删除成功');
                } else {
                    $errors = $profiletag->errors();
                    $this->Util->ajaxReturn(true,getMessage($errors));
                }
          }
    }

/**
* get jqgrid data 
*
* @return json
*/
public function getDataList()
{
        $this->request->allowMethod('ajax');
        $page = $this->request->data('page');
        $rows = $this->request->data('rows');
        $sort = 'Profiletag.'.$this->request->data('sidx');
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
        $data = $this->getJsonForJqrid($page, $rows, '', $sort, $order,$where);
        $this->autoRender = false;
        $this->response->type('json');
        echo json_encode($data);
}

/**
* export csv
*
* @return csv 
*/
public function exportExcel()
{
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
        $Table =  $this->Profiletag;
        $column = ['个人标签'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['name']);
         if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = 'Profiletag_'.date('Y-m-d').'.csv';
        \Wpadmin\Utils\Export::exportCsv($column,$res,$filename);

}
}
