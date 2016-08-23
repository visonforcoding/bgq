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
        $needCountsRes = $UserTable->connection()->execute('select count(DISTINCT u.id) as nums from user u
                        inner join 
                        (select * from need  order by create_time desc ) n
                        on n.user_id = u.id where u.id != -1 and n.`status` = 0 
                      ')->fetchAll('assoc');
        
        $needCounts = $needCountsRes[0]['nums'];
        //待处理提现总数
        $WithdrawTable = \Cake\ORM\TableRegistry::get('Withdraw');
        $withdrawCounts = $WithdrawTable->find()->where(['status' => 0])->count();
        //活动赞助待处理
        $ActivityapplyTable = \Cake\ORM\TableRegistry::get('Activityapply');
        $applyCounts = $ActivityapplyTable->find()->contain(['Activities'])->where(['Activityapply.is_check'=>0,'must_check'=>1])->count();
        //活动报名待处理
        $SponsorTable = \Cake\ORM\TableRegistry::get('Sponsor');
        $sponsorCounts = $SponsorTable->find()->where(['status'=>0])->count();
        $this->set([
            'savantCounts' => $savantCounts,
            'needCounts' => $needCounts,
            'withdrawCounts' => $withdrawCounts,
            'sponsorCounts' => $sponsorCounts,
            'applyCounts' => $applyCounts,
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
        $month = date('m');
        $label = $month.'月用户注册数';
        echo $this->Chart->setLineChartByDayWithMonth($result,$label);
        exit();
    }
    
    public function getActivityApplyByDayWithMonth() {
        $connection = \Cake\Datasource\ConnectionManager::get('default');
        $result = $connection->execute('select count(id) as nums,date(aa.create_time) as date,day(aa.create_time) as day from activityapply aa
                    where month(aa.create_time) = month(now())
                    group by date(aa.create_time)')->fetchAll('assoc');
        $this->loadComponent('Chart');
        $month = date('m');
        $label = $month.'月活动报名数';
        echo $this->Chart->setLineChartByDayWithMonth($result,$label,['backgroundColor'=>4,'borderCapStyle'=>'round']);
        exit();
    }
    
    public function getMeetByDayWithMonth() {
        $connection = \Cake\Datasource\ConnectionManager::get('default');
        $result = $connection->execute('select count(*) as nums,day(sb.create_time) as day,date(sb.create_time) as date from subject_book sb
                    where month(sb.create_time) = month(now())
                    group by date(sb.create_time)')->fetchAll('assoc');
        $this->loadComponent('Chart');
        $month = date('m');
        $label = $month.'月用户约见数';
        echo $this->Chart->setLineChartByDayWithMonth($result,$label,['backgroundColor'=>11,'borderCapStyle'=>'round']);
        exit();
    }
    

}
