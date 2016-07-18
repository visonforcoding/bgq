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
        $savantCounts = $UserTable->find()->where(['savant_status'=>2])->count();
        //小秘书待处理个数
        $NeedTable = \Cake\ORM\TableRegistry::get('Need');
        $needCounts = $NeedTable->find()->where(['status'=>0])->count();
        //会员今日新增
        $today = date('Y-m-d');
        $newUserCounts = $UserTable->find()->where("enabled = 1 and date(`create_time`) = '$today'")->count();
        //新增资讯
        $NewsTable = \Cake\ORM\TableRegistry::get('News');
        $newsCounts = $NewsTable->find()->where("date(`create_time`) = '$today'")->count();
        //新增活动
        $ActivityTable = \Cake\ORM\TableRegistry::get('Activity');
        $activityCounts = $ActivityTable->find()->where("date(`create_time`) = '$today'")->count();
        $this->set([
            'savantCounts'=>$savantCounts,
            'needCounts'=>$needCounts,
            'newUserCounts'=>$newUserCounts,
            'newsCount'=>$newsCounts,
            'activityCounts'=>$newsCounts
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
                        group by i.id')->fetchAll('assoc');
        $data = [];
        $labels = [];
        foreach ($result as $key=>$value){
            $data[] = $value['user_count'];
            $labels[] = $value['name'];
        }
        $this->loadComponent('Chart');
        echo $this->Chart->setPieChart($data,$labels);
        exit();
    }

}
