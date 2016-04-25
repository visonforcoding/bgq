<?php
namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Need Controller
 *
 * @property \App\Model\Table\NeedTable $Need
 */
class NeedController extends AppController
{

/**
* Index method
*
* @return void
*/
public function index()
{
$this->set('need', $this->Need);
}

    /**
     * View method
     *
     * @param string|null $id Need id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->autoLayout(false);
        $need = $this->Need->get($id, [
            'contain' => ['User']
        ]);
        $need->is_read = 1;//修改为已读
        $this->Need->save($need);
        $this->set('need', $need);
        $this->set('_serialize', ['need']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $need = $this->Need->newEntity();
        if ($this->request->is('post')) {
            $need = $this->Need->patchEntity($need, $this->request->data);
            if ($this->Need->save($need)) {
                 $this->Util->ajaxReturn(true,'添加成功');
            } else {
                 $errors = $need->errors();
                 $this->Util->ajaxReturn(['status'=>false, 'msg'=>getMessage($errors),'errors'=>$errors]);
            }
        }
                $users = $this->Need->User->find('list', ['limit' => 200]);
        $this->set(compact('need', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Need id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
         $need = $this->Need->get($id,[
            'contain' => []
        ]);
        if ($this->request->is(['post','put'])) {
            $need = $this->Need->patchEntity($need, $this->request->data);
            if ($this->Need->save($need)) {
                  $this->Util->ajaxReturn(true,'修改成功');
            } else {
                 $errors = $need->errors();
               $this->Util->ajaxReturn(false,getMessage($errors));
            }
        }
                  $users = $this->Need->User->find('list', ['limit' => 200]);
                $this->set(compact('need', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Need id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod('post');
         $id = $this->request->data('id');
                if ($this->request->is('post')) {
                $need = $this->Need->get($id);
                 if ($this->Need->delete($need)) {
                     $this->Util->ajaxReturn(true,'删除成功');
                } else {
                    $errors = $need->errors();
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
        $sort = 'need.'.$this->request->data('sidx');
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $where = [];
        if (!empty($keywords)) {
            $where['OR']= [['user.`truename` like' =>"%$keywords%"],['msg like'=>"%$keywords%"]];
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
//             var_dump($begin_time);die;
            $where['and'] = [['date(need.`create_time`) >' => $begin_time], ['date(need.`create_time`) <' => $end_time]];
        }
        $query =  $this->Need->find()->contain(['User']);
        $query->hydrate(false);
        if (!empty($where)) {
            $query->where($where);
        }
        $nums = $query->count();
        $query->contain(['User']);
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        
        $query->limit(intval($rows))
              ->page(intval($page));
        $res = $query->toArray();
        foreach ($res as $k=>$v)
        {
        	$res[$k]['is_read'] = $v['is_read'] ? '已读':'未读';
        }
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
//                 var_dump($data);die;
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
        $Table =  $this->Need;
        $column = ['用户','内容','状态','创建时间','修改时间'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['user_id','msg','status','create_time','update_time']);
         if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = 'Need_'.date('Y-m-d').'.csv';
        \Wpadmin\Utils\Export::exportCsv($column,$res,$filename);

}
}
