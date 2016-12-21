<?php
namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * ClassLearn Controller
 *
 * @property \App\Model\Table\ClassLearnTable $ClassLearn
 */
class ClassLearnController extends AppController
{

/**
* Index method
*
* @return void
*/
public function index()
{
$this->set('classLearn', $this->ClassLearn);
}

    /**
     * View method
     *
     * @param string|null $id Class Learn id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->autoLayout(false);
        $classLearn = $this->ClassLearn->get($id, [
            'contain' => []
        ]);
        $this->set('classLearn', $classLearn);
        $this->set('_serialize', ['classLearn']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $classLearn = $this->ClassLearn->newEntity();
        if ($this->request->is('post')) {
            $classLearn = $this->ClassLearn->patchEntity($classLearn, $this->request->data);
            if ($this->ClassLearn->save($classLearn)) {
                 $this->Util->ajaxReturn(true,'添加成功');
            } else {
                 $errors = $classLearn->errors();
                 $this->Util->ajaxReturn(['status'=>false, 'msg'=>getMessage($errors),'errors'=>$errors]);
            }
        }
                $this->set(compact('classLearn'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Class Learn id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
         $classLearn = $this->ClassLearn->get($id,[
            'contain' => []
        ]);
        if ($this->request->is(['post','put'])) {
            $classLearn = $this->ClassLearn->patchEntity($classLearn, $this->request->data);
            if ($this->ClassLearn->save($classLearn)) {
                  $this->Util->ajaxReturn(true,'修改成功');
            } else {
                 $errors = $classLearn->errors();
               $this->Util->ajaxReturn(false,getMessage($errors));
            }
        }
                  $this->set(compact('classLearn'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Class Learn id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod('post');
         $id = $this->request->data('id');
                if ($this->request->is('post')) {
                $classLearn = $this->ClassLearn->get($id);
                 if ($this->ClassLearn->delete($classLearn)) {
                     $this->Util->ajaxReturn(true,'删除成功');
                } else {
                    $errors = $classLearn->errors();
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
        $sort = 'ClassLearn.'.$this->request->data('sidx');
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
        $Table =  $this->ClassLearn;
        $column = ['用户id','课程id','创建时间'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['uid','class','create_time']);
         if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = 'ClassLearn_'.date('Y-m-d').'.csv';
        \Wpadmin\Utils\Export::exportCsv($column,$res,$filename);

}
}
