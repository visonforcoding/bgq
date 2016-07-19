<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Index Controller
 *
 * @property \App\Model\Table\IndexTable $Index
 * @property \App\Controller\Component\ChartComponent $Chart       
 */
class IndexController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        //待处理专家认证个数
        $UserTable = \Cake\ORM\TableRegistry::get('User');
        $savantCounts = $UserTable->find()->where(['savant_status' => 2])->count();
        //小秘书待处理个数
        $NeedTable = \Cake\ORM\TableRegistry::get('Need');
        $needCounts = $NeedTable->find()->where(['status' => 0])->count();

        //会员总量
        $today = date('Y-m-d');
        $userCounts = $UserTable->find()->where("enabled = 1")->count();
        //新增资讯
        $NewsTable = \Cake\ORM\TableRegistry::get('News');
        $newsTotalCounts = $NewsTable->find()->count();

        //活动总数
        $ActivityTable = \Cake\ORM\TableRegistry::get('Activity');
        $activityCounts = $ActivityTable->find()->count();
        $this->set([
            'savantCounts' => $savantCounts,
            'userCounts' => $userCounts,
            'needCounts' => $needCounts,
            'newsTotalCounts' => $newsTotalCounts,
            'activityCounts' => $activityCounts
        ]);
    }

    /**
     * 获取用户的行业占比数据
     */
    public function getUserIndustryProportion() {
        $connection = \Cake\Datasource\ConnectionManager::get('default');
        $result = $connection->execute('select u.id,u.truename,i.name,count(u.id) as user_count from `user` u
                    left join user_industry ui
                    on ui.user_id = u.id
                    join industry i 
                    on i.id = ui.industry_id
                    where i.pid = 1
                    group by i.id')->fetchAll('assoc');
        $data = [];
        $labels = [];
        foreach ($result as $key => $value) {
            $data[] = $value['user_count'];
            $labels[] = $value['name'];
        }
        $this->loadComponent('Chart');
        echo $this->Chart->setPieChart($data, $labels);
        exit();
    }

    public function getNewUserByDayWithMonth() {
        $connection = \Cake\Datasource\ConnectionManager::get('default');
        $result = $connection->execute('select count(u.id) as nums,day(u.create_time) as day,date(u.create_time) as date
                        from `user` u where month(u.create_time) = month(now()) 
                        group by date(u.create_time)')->fetchAll('assoc');
        $this->loadComponent('Chart');
        echo $this->Chart->setLineChartByDayWithMonth($result);
        exit();
    }

}
