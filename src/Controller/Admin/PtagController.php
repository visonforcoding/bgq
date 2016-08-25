<?php
namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Ptag Controller
 *
 * @property \App\Model\Table\PtagTable $Ptag
 */
class PtagController extends AppController
{

/**
* Index method
*
* @return void
*/
public function index()
{
$this->set('ptag', $this->Ptag);
}

    /**
     * View method
     *
     * @param string|null $id Ptag id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->autoLayout(false);
        $ptag = $this->Ptag->get($id, [
            'contain' => []
        ]);
        $this->set('ptag', $ptag);
        $this->set('_serialize', ['ptag']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ptag = $this->Ptag->newEntity();
        if ($this->request->is('post')) {
            $ptag = $this->Ptag->patchEntity($ptag, $this->request->data);
            if ($this->Ptag->save($ptag)) {
                 $this->Util->ajaxReturn(true,'添加成功');
            } else {
                 $errors = $ptag->errors();
                 $this->Util->ajaxReturn(['status'=>false, 'msg'=>getMessage($errors),'errors'=>$errors]);
            }
        }
                $this->set(compact('ptag'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Ptag id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
         $ptag = $this->Ptag->get($id,[
            'contain' => []
        ]);
        if ($this->request->is(['post','put'])) {
            $ptag = $this->Ptag->patchEntity($ptag, $this->request->data);
            if ($this->Ptag->save($ptag)) {
                  $this->Util->ajaxReturn(true,'修改成功');
            } else {
                 $errors = $ptag->errors();
               $this->Util->ajaxReturn(false,getMessage($errors));
            }
        }
                  $this->set(compact('ptag'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Ptag id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod('post');
         $id = $this->request->data('id');
                if ($this->request->is('post')) {
                $ptag = $this->Ptag->get($id);
                 if ($this->Ptag->delete($ptag)) {
                     $this->Util->ajaxReturn(true,'删除成功');
                } else {
                    $errors = $ptag->errors();
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
        $sort = 'Ptag.'.$this->request->data('sidx');
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
            $where['and'] = [['date(`create_time`) >' => $begin_time], ['date(`create_time`) <' => $end_time]];
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
            $where['and'] = [['date(`create_time`) >' => $begin_time], ['date(`create_time`) <' => $end_time]];
        }
        $Table =  $this->Ptag;
        $column = ['ptag','描述','create_time','update_time'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['ptag','desc','create_time','update_time']);
         if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = 'Ptag_'.date('Y-m-d').'.csv';
        \Wpadmin\Utils\Export::exportCsv($column,$res,$filename);

}
}
