<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Index Controller
 *
 * @property \App\Model\Table\IndexTable $Index
 * @property \App\Controller\Component\EchartComponent $Echart       
 */
class ActivityChartController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        //待处理专家认证个数
    }
    
    
    /**
     * 活动报名统计
     */
    public function getApplyChart(){
        $date = $this->request->query('date');
        $date = date('Y-m-d H:i:s',  strtotime($date));
        $type = $this->request->query('type');
        $connection = \Cake\Datasource\ConnectionManager::get('default');
        if($type=='month'){
            $sql = "select count(u.id) as nums,day(u.create_time) as time_item,date(u.create_time) as date
                            from `activityapply` u where month(u.create_time) = month('".$date."')
                            group by date(u.create_time)";
            $name = date('n',  strtotime($date)).'月';
        }
        if($type=='year'){
            $sql = "select count(u.id) as nums,month(u.create_time) as time_item
                            from `activityapply` u where year(u.create_time) = year('".$date."')
                            group by month(u.create_time)";
            $name = date('Y',  strtotime($date)).'年';
        }
        if($type=='week'){
            $sql = "select count(u.id) as nums,weekday(u.create_time) as time_item
                            from `activityapply` u where week(u.create_time) = week('".$date."')
                            group by weekday(u.create_time)";
            $name = date('Y',  strtotime($date)).'年第'.date('W',  strtotime($date)).'周';
        }
        $result = $connection->execute($sql)->fetchAll('assoc');
        $this->loadComponent('Echart');
        $title['text'] = '活动报名统计';
        echo $this->Echart->setLineChart($result,$type,$name,$title,'人次');
        exit();
    }
    
    /**
     * 活动收入
     */
    public function getIncomeChart(){
        $date = $this->request->query('date');
        $date = date('Y-m-d H:i:s',  strtotime($date));
        $type = $this->request->query('type');
        $connection = \Cake\Datasource\ConnectionManager::get('default');
        if($type=='month'){
            $sql = "select count(aa.id),sum(a.apply_fee) as nums,day(aa.create_time) as time_item
                            from activityapply aa 
                            join activity a 
                            on a.id = aa.activity_id
                            where a.apply_fee > 0 and  month(aa.create_time) = month('".$date."')
                            group by date(aa.create_time)";
            $name = date('n',  strtotime($date)).'月';
        }
        if($type=='year'){
            $sql = "select count(aa.id),sum(a.apply_fee) as nums,month(aa.create_time) as time_item
                            from activityapply aa 
                            join activity a 
                            on a.id = aa.activity_id
                            where a.apply_fee > 0 and  year(aa.create_time) = year('".$date."')
                            group by month(aa.create_time)";
            $name = date('Y',  strtotime($date)).'年';
        }
        if($type=='week'){
            $sql = "select count(aa.id),sum(a.apply_fee) as nums,weekday(aa.create_time) as time_item
                            from activityapply aa 
                            join activity a 
                            on a.id = aa.activity_id
                            where a.apply_fee > 0  and week(aa.create_time) = week('".$date."')
                            group by weekday(aa.create_time)";
            $name = date('Y',  strtotime($date)).'年第'.date('W',  strtotime($date)).'周';
        }
        $result = $connection->execute($sql)->fetchAll('assoc');
        $this->loadComponent('Echart');
        $title['text'] = '活动收入统计';
        echo $this->Echart->setLineChart($result,$type,$name,$title,'元');
        exit();
    }
    
    
    /**
     * 点赞
     */
   public function getPraiseChart(){
        $date = $this->request->query('date');
        $date = date('Y-m-d H:i:s',  strtotime($date));
        $type = $this->request->query('type');
        $connection = \Cake\Datasource\ConnectionManager::get('default');
        if($type=='month'){
            $sql = "select count(u.id) as nums,day(u.create_time) as time_item,date(u.create_time) as date
                            from `like_logs` u where u.type = 0 and month(u.create_time) = month('".$date."')
                            group by date(u.create_time)";
            $name = date('n',  strtotime($date)).'月';
        }
        if($type=='year'){
            $sql = "select count(u.id) as nums,month(u.create_time) as time_item
                            from `like_logs` u where u.type = 0 and year(u.create_time) = year('".$date."')
                            group by month(u.create_time)";
            $name = date('Y',  strtotime($date)).'年';
        }
        if($type=='week'){
            $sql = "select count(u.id) as nums,weekday(u.create_time) as time_item
                            from `like_logs` u where u.type = 0 and week(u.create_time) = week('".$date."')
                            group by weekday(u.create_time)";
            $name = date('Y',  strtotime($date)).'年第'.date('W',  strtotime($date)).'周';
        }
        $result = $connection->execute($sql)->fetchAll('assoc');
        $this->loadComponent('Echart');
        $title['text'] = '资讯点赞统计';
        echo $this->Echart->setLineChart($result,$type,$name,$title,'人次');
        exit();
    }
    
    
     /**
     * 评论统计
     */
    public function getCommentChart(){
        $date = $this->request->query('date');
        $date = date('Y-m-d H:i:s',  strtotime($date));
        $type = $this->request->query('type');
        $connection = \Cake\Datasource\ConnectionManager::get('default');
        if($type=='month'){
            $sql = "select count(u.id) as nums,day(u.create_time) as time_item,date(u.create_time) as date
                            from `activitycom` u where month(u.create_time) = month('".$date."')
                            group by date(u.create_time)";
            $name = date('n',  strtotime($date)).'月';
        }
        if($type=='year'){
            $sql = "select count(u.id) as nums,month(u.create_time) as time_item
                            from `activitycom` u where year(u.create_time) = year('".$date."')
                            group by month(u.create_time)";
            $name = date('Y',  strtotime($date)).'年';
        }
        if($type=='week'){
            $sql = "select count(u.id) as nums,weekday(u.create_time) as time_item
                            from `activitycom` u where week(u.create_time) = week('".$date."')
                            group by weekday(u.create_time)";
            $name = date('Y',  strtotime($date)).'年第'.date('W',  strtotime($date)).'周';
        }
        $result = $connection->execute($sql)->fetchAll('assoc');
        $this->loadComponent('Echart');
        $title['text'] = '资讯评论统计';
        echo $this->Echart->setLineChart($result,$type,$name,$title,'人次');
        exit();
    }
    
    
     /**
     * 赞助
     */
    public function getSponsorChart(){
        $date = $this->request->query('date');
        $date = date('Y-m-d H:i:s',  strtotime($date));
        $type = $this->request->query('type');
        $connection = \Cake\Datasource\ConnectionManager::get('default');
        if($type=='month'){
            $sql = "select count(u.id) as nums,day(u.create_time) as time_item,date(u.create_time) as date
                            from `sponsor` u where month(u.create_time) = month('".$date."')
                            group by date(u.create_time)";
            $name = date('n',  strtotime($date)).'月';
        }
        if($type=='year'){
            $sql = "select count(u.id) as nums,month(u.create_time) as time_item
                            from `sponsor` u where year(u.create_time) = year('".$date."')
                            group by month(u.create_time)";
            $name = date('Y',  strtotime($date)).'年';
        }
        if($type=='week'){
            $sql = "select count(u.id) as nums,weekday(u.create_time) as time_item
                            from `sponsor` u where week(u.create_time) = week('".$date."')
                            group by weekday(u.create_time)";
            $name = date('Y',  strtotime($date)).'年第'.date('W',  strtotime($date)).'周';
        }
        $result = $connection->execute($sql)->fetchAll('assoc');
        $this->loadComponent('Echart');
        $title['text'] = '资讯评论统计';
        echo $this->Echart->setLineChart($result,$type,$name,$title,'人次');
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
        $title['text'] = '会员占比';
        echo $this->Echart->setPieChart($result, $name,$title);
        exit();
    }


}
