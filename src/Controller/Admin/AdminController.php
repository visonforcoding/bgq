<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Admin Controller
 *
 * @property \Wpadmin\Model\Table\AdminTable $Admin
 */
class AdminController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadModel('Wpadmin.Admin');
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->set('admin', $this->Admin);
    }

    /**
     * View method
     *
     * @param string|null $id Admin id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $admin = $this->Admin->get($id, [
            'contain' => []
        ]);
        $this->set('admin', $admin);
        $this->set('_serialize', ['admin']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $admin = $this->Admin->newEntity();
        if ($this->request->is('post')) {
            $admin = $this->Admin->patchEntity($admin, $this->request->data);
            if ($this->Admin->save($admin)) {
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $admin->errors();
                $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }
        $this->set(compact('admin'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Admin id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $admin = $this->Admin->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['post', 'put'])) {
            $admin = $this->Admin->patchEntity($admin, $this->request->data);
            if ($this->Admin->save($admin)) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $admin->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $this->set(compact('admin'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Admin id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $admin = $this->Admin->get($id);
            if ($this->Admin->delete($admin)) {
                $this->Util->ajaxReturn(true, '删除成功');
            } else {
                $errors = $admin->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
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
        $sort = 'Admin.' . $this->request->data('sidx');
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
        $query = $this->Admin->find();
        $query->hydrate(false);
        if (!empty($where)) {
            $query->where($where);
        }
        $nums = $query->count();
        $query->contain(['Menus']);
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
        $Table = $this->Admin;
        $column = ['用户名', '真实姓名', '密码', '手机号', '1启用0禁用', '创建时间', '修改时间', '登录时间', '登录ip'];
        $query = $Table->find();
        $query->find(['Menus']);
        $query->hydrate(false);
        $query->select(['username', 'truename', 'password', 'phone', 'enabled', 'ctime', 'utime', 'login_time', 'login_ip']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = 'Admin_' . date('Y-m-d') . '.csv';
        \Wpadmin\Utils\Export::exportCsv($column, $res, $filename);
    }

    /**
     * 
     */
    public function config($id) {
        $admin = $this->Admin->get($id, [
            'contain' => ['Menus'],
        ]);
        if ($this->request->is('post')) {
            $admin = $this->Admin->patchEntity($admin, $this->request->data());
            if ($this->Admin->save($admin)) {
                \Cake\Cache\Cache::delete($admin->username . '_menus'); //更新菜单缓存文件
                $this->Util->ajaxReturn(true, '配置成功');
            } else {
                $errors = $admin->errors();
                $this->Util->ajaxReturn(false, $errors);
            }
        }
        $selMenuIds = [];
        $adminMenus = $admin->menus;
        foreach ($adminMenus as $key => $value) {
            $selMenuIds[] = $value['id'];
        }
        $MenuTable = \Cake\ORM\TableRegistry::get('Menu');
        $menus = $MenuTable->find()->hydrate(false)->all()->toArray();
        $menus = \Wpadmin\Utils\Util::tree($menus, 0, 'id', 'pid');
        $this->set([
            'menus' => $menus,
            'selMenuIds' => $selMenuIds
        ]);
    }

    public function profile() {
        $id = $this->_user->id;
        $admin = $this->Admin->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['post', 'put'])) {
            $admin = $this->Admin->patchEntity($admin, $this->request->data);
            if ($this->Admin->save($admin)) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $admin->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $this->set(compact('admin'));
    }

}
