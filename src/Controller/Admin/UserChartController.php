<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Index Controller
 *
 * @property \App\Model\Table\IndexTable $Index
 * @property \App\Controller\Component\EchartComponent $Echart       
 */
class UserChartController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        //待处理专家认证个数
    }
    
    public function getRegisterChart(){
        $date = $this->request->query('date');
        $date = date('Y-m-d H:i:s',  strtotime($date));
        $type = $this->request->query('type');
        $connection = \Cake\Datasource\ConnectionManager::get('default');
        if($type=='month'){
            $sql = "select count(u.id) as nums,day(u.create_time) as time_item,date(u.create_time) as date
                            from `user` u where month(u.create_time) = month('".$date."')
                            group by date(u.create_time)";
            $name = date('n',  strtotime($date)).'月';
        }
        if($type=='year'){
            $sql = "select count(u.id) as nums,month(u.create_time) as time_item
                            from `user` u where year(u.create_time) = year('".$date."')
                            group by month(u.create_time)";
            $name = date('Y',  strtotime($date)).'年';
        }
        if($type=='week'){
            $sql = "select count(u.id) as nums,weekday(u.create_time) as time_item
                            from `user` u where week(u.create_time) = week('".$date."')
                            group by weekday(u.create_time)";
            $name = date('Y',  strtotime($date)).'年第'.date('W',  strtotime($date)).'周';
        }
        $result = $connection->execute($sql)->fetchAll('assoc');
        $this->loadComponent('Echart');
        $title['text'] = '注册用户统计';
        echo $this->Echart->setLineChart($result,$type,$name,$title,'个');
        exit();
    }
    
    /**
     * 关注统计
     */
    public function getFocusChart(){
        $date = $this->request->query('date');
        $date = date('Y-m-d H:i:s',  strtotime($date));
        $type = $this->request->query('type');
        $connection = \Cake\Datasource\ConnectionManager::get('default');
        if($type=='month'){
            $sql = "select count(u.id) as nums,day(u.create_time) as time_item,date(u.create_time) as date
                            from `user_fans` u where month(u.create_time) = month('".$date."')
                            group by date(u.create_time)";
            $name = date('n',  strtotime($date)).'月';
        }
        if($type=='year'){
            $sql = "select count(u.id) as nums,month(u.create_time) as time_item
                            from `user_fans` u where year(u.create_time) = year('".$date."')
                            group by month(u.create_time)";
            $name = date('Y',  strtotime($date)).'年';
        }
        if($type=='week'){
            $sql = "select count(u.id) as nums,weekday(u.create_time) as time_item
                            from `user_fans` u where week(u.create_time) = week('".$date."')
                            group by weekday(u.create_time)";
            $name = date('Y',  strtotime($date)).'年第'.date('W',  strtotime($date)).'周';
        }
        $result = $connection->execute($sql)->fetchAll('assoc');
        $this->loadComponent('Echart');
        $title['text'] = '用户关注统计';
        echo $this->Echart->setLineChart($result,$type,$name,$title,'次');
        exit();
    }
    
    /**
     * 递名片统计
     */
    public function getMpChart(){
        $date = $this->request->query('date');
        $date = date('Y-m-d H:i:s',  strtotime($date));
        $type = $this->request->query('type');
        $connection = \Cake\Datasource\ConnectionManager::get('default');
        if($type=='month'){
            $sql = "select count(u.id) as nums,day(u.create_time) as time_item,date(u.create_time) as date
                            from `card_box` u where month(u.create_time) = month('".$date."')
                            group by date(u.create_time)";
            $name = date('n',  strtotime($date)).'月';
        }
        if($type=='year'){
            $sql = "select count(u.id) as nums,month(u.create_time) as time_item
                            from `card_box` u where year(u.create_time) = year('".$date."')
                            group by month(u.create_time)";
            $name = date('Y',  strtotime($date)).'年';
        }
        if($type=='week'){
            $sql = "select count(u.id) as nums,weekday(u.create_time) as time_item
                            from `card_box` u where week(u.create_time) = week('".$date."')
                            group by weekday(u.create_time)";
            $name = date('Y',  strtotime($date)).'年第'.date('W',  strtotime($date)).'周';
        }
        $result = $connection->execute($sql)->fetchAll('assoc');
        $this->loadComponent('Echart');
        $title['text'] = '用户赠名片统计';
        echo $this->Echart->setLineChart($result,$type,$name,$title,'次');
        exit();
    }
    
    /**
     * 用户行业分布
     */
    public function getIndustryPieChart(){
        $connection = \Cake\Datasource\ConnectionManager::get('default');
        $result = $connection->execute('select u.id,u.truename,i.name,count(u.id) as nums from `user` u
                    left join user_industry ui
                    on ui.user_id = u.id
                    join industry i 
                    on i.id = ui.industry_id
                    where i.pid = 1
                    group by i.id')->fetchAll('assoc');
        $this->loadComponent('Echart');
        $name = '用户行业分布';
        $title['text'] = '用户行业分布';
        echo $this->Echart->setPieChart($result, $name,$title);
        exit();
    }
    
    /**
     * 专家占比
     */
    public function getLevelPieChart(){
        $connection = \Cake\Datasource\ConnectionManager::get('default');
        $result = $connection->execute('select u.`level`,count(u.id) as nums from user u where u.enabled = 1 '
                . 'and u.is_del = 0 and  (u.`level` = 1 or u.`level` = 2) group by u.`level`')
                ->fetchAll('assoc');
        foreach ($result as $key=>$item){
            $result[$key]['name'] = $item['level']=='1'?'普通用户':'会员';
        }
        $this->loadComponent('Echart');
        $name = '用户行业分布';
        $title['text'] = '专家占比';
        echo $this->Echart->setPieChart($result, $name,$title);
        exit();
    }


}
