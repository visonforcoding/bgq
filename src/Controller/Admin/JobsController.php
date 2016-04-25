<?php
namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;
use Cake\Datasource\ConnectionManager;
/**
 * Jobs Controller
 *
 * @property \App\Model\Table\JobsTable $Jobs
 */
class JobsController extends AppController
{

/**
* Index method
*
* @return void
*/
public function index()
{
    $industries = $this->Jobs->Industry->find('list', ['limit' => 200])->toArray();
    $this->set('industries', $industries);
    $this->set('jobs', $this->Jobs);
}

    /**
     * View method
     *
     * @param string|null $id Job id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {   
        $id=$_GET['id'];
        $this->viewBuilder()->autoLayout(false);
        $job = $this->Jobs->get($id, [
            'contain' => []
        ]);
        $this->set('job', $job);
        $this->set('_serialize', ['job']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $job = $this->Jobs->newEntity();
        $job->user_id = $this->_user->id;
        //$job->industry_id = $this->_industry->id;
        if ($this->request->is('post')) {
            $job = $this->Jobs->patchEntity($job, $this->request->data);
            if ($this->Jobs->save($job)) {
                 $this->Util->ajaxReturn(true,'添加成功');
            } else {
                 $errors = $job->errors();
                 $this->Util->ajaxReturn(['status'=>false, 'msg'=>getMessage($errors),'errors'=>$errors]);
            }
        }
        $this->set(compact('job', 'users', 'industries'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Job id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
         $job = $this->Jobs->get($id,[
            'contain' => []
        ]);
         //$job->user_id = $this->_user->id;
        if ($this->request->is(['post','put'])) {
            $job = $this->Jobs->patchEntity($job, $this->request->data);
            $job->update_time= date('Y-m-d H:i:s');
            $industry_ids=$this->request->data('industry_id');
            if($industry_ids){
               $job->industry_id= implode(',',$industry_ids); 
            }
            if ($this->Jobs->save($job)) {
                  $this->Util->ajaxReturn(true,'修改成功');
            } else {
                 $errors = $job->errors();
               $this->Util->ajaxReturn(false,getMessage($errors));
            }
        }
                $users = $this->Jobs->User->find('list', ['limit' => 200]);
                $industries = $this->Jobs->Industry->find('list', ['limit' => 200]);
                $this->set(compact('job', 'users', 'industries'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Job id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod('post');
         $id = $this->request->data('id');
                if ($this->request->is('post')) {
                $job = $this->Jobs->get($id);
                 if ($this->Jobs->delete($job)) {
                     $this->Util->ajaxReturn(true,'删除成功');
                } else {
                    $errors = $job->errors();
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
        $sort = 'jobs.'.$this->request->data('sidx');
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
                $query =  $this->Jobs->find();
        $query->hydrate(false);
        if (!empty($where)) {
            $query->where($where);
        }
        $nums = $query->count();
        $query->contain(['User', 'Industry']);
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
        $Table =  $this->Jobs;
        $column = ['用户id','公司','招聘人数','薪资范围，逗号分隔','行业id,用逗号分隔','工作地点','招聘简介','招聘状态：1.提交，2.通过，3.拒绝','排序','创建时间','更新时间'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['user_id','company','num','offer_range','industry_id','offer_addr','job_desc','job_status','job_order','create_time','update_time']);
         if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = 'Jobs_'.date('Y-m-d').'.csv';
        \Wpadmin\Utils\Export::exportCsv($column,$res,$filename);

}
}
