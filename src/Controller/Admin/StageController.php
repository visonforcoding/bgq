<?php
namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Stage Controller
 *
 * @property \App\Model\Table\StageTable $Stage
 */
class StageController extends AppController
{

/**
* Index method
*
* @return void
*/
public function index()
{
$this->set('stage', $this->Stage);
}

    /**
     * View method
     *
     * @param string|null $id Stage id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->autoLayout(false);
        $stage = $this->Stage->get($id, [
            'contain' => ['Projrong']
        ]);
        $this->set('stage', $stage);
        $this->set('_serialize', ['stage']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $stage = $this->Stage->newEntity();
        if ($this->request->is('post')) {
            $stage = $this->Stage->patchEntity($stage, $this->request->data);
            if ($this->Stage->save($stage)) {
                 $this->Util->ajaxReturn(true,'添加成功');
            } else {
                 $errors = $stage->errors();
                 $this->Util->ajaxReturn(['status'=>false, 'msg'=>getMessage($errors),'errors'=>$errors]);
            }
        }
                $this->set(compact('stage'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Stage id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
         $stage = $this->Stage->get($id,[
            'contain' => []
        ]);
        if ($this->request->is(['post','put'])) {
            $stage = $this->Stage->patchEntity($stage, $this->request->data);
            if ($this->Stage->save($stage)) {
                  $this->Util->ajaxReturn(true,'修改成功');
            } else {
                 $errors = $stage->errors();
               $this->Util->ajaxReturn(false,getMessage($errors));
            }
        }
                  $this->set(compact('stage'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Stage id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod('post');
         $id = $this->request->data('id');
                if ($this->request->is('post')) {
                $stage = $this->Stage->get($id);
                 if ($this->Stage->delete($stage)) {
                     $this->Util->ajaxReturn(true,'删除成功');
                } else {
                    $errors = $stage->errors();
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
        $sort = 'Stage.'.$this->request->data('sidx');
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
                $query =  $this->Stage->find();
        $query->hydrate(false);
        if (!empty($where)) {
            $query->where($where);
        }
        $nums = $query->count();
        $query->contain(['Projrong']);
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
        $Table =  $this->Stage;
        $column = ['name'];
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
        $filename = 'Stage_'.date('Y-m-d').'.csv';
        \Wpadmin\Utils\Export::exportCsv($column,$res,$filename);

}
}
