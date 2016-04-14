<?php

namespace Wpadmin\View\Cell;

use Cake\View\Cell;

/**
 * Menu cell
 */
class MenuCell extends Cell {

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];
    protected $_breadFirst;
    protected $_breadSecond;
    protected $_menus;
    protected $_url;
    protected $_active;
    protected $_pageTitle;

    public function __construct(\Cake\Network\Request $request = null, \Cake\Network\Response $response = null, \Cake\Event\EventManager $eventManager = null, array $cellOptions = array()) {
        parent::__construct($request, $response, $eventManager, $cellOptions);
        $this->initData();
    }

    /**
     * Default display method.
     *
     * @return void
     */
    public function display() {

        $this->set('menus', $this->_menus);
        $this->set('active', $this->_active);
        $this->set('url', $this->_url);
    }

    public function bread() {
        $this->set('breadFirst', $this->_breadFirst);
        $this->set('breadSecond', $this->_breadSecond);
    }

    public function title() {
        $this->set('pageTitle', $this->_pageTitle);
    }

    protected function initData() {
        $menus = \Cake\Cache\Cache::read('admin_menus');
        if ($menus === false) {
            $Menu = \Cake\ORM\TableRegistry::get('menu');
            $menus = $Menu->find('threaded', [
                        'keyField' => 'id',
                        'parentField' => 'pid'
                    ])->hydrate(false)->where('status = 1')->orderDesc('rank')->toArray();
            $menus = \Wpadmin\Utils\Util::getMenu($menus);
            \Cake\Cache\Cache::write('admin_menus', $menus);
        }
        $this->_menus = $menus;
        $controller = strtolower($this->request->param('controller'));
        $action = strtolower($this->request->param('action'));
        $url = '/admin/' . $controller . '/' . $action;
        $this->_url = $url;
        $active = null;
        foreach ($menus as $value) {
            if (isset($value['children'])) {
                foreach ($value['children'] as $sub_menu) {
                    if ($sub_menu['node'] == $url) {
                        $this->_pageTitle = $sub_menu['name'];
                        $this->_breadFirst = ['name' => $value['name'], 'node' => $value['node']];
                        $this->_breadSecond = ['name' => $sub_menu['name'], 'node' => $sub_menu['node']];
                        break;
                    }
                    if (isset($sub_menu['children'])) {
                        foreach ($sub_menu['children'] as $v) {
                            if ($v['node'] == $url) {
                                $active = $sub_menu['node'];
                                $this->_active = $active;
                                $this->_pageTitle = $v['name'];
                                $this->_breadFirst = ['name' => $value['name'], 'node' => $value['node']];
                                $this->_breadSecond = ['name' => $sub_menu['name'], 'node' => $sub_menu['node']];
                            }
                        }
                    }
                }
            }
        }
    }

}
