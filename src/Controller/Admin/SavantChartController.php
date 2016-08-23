<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Index Controller
 *
 * @property \App\Model\Table\IndexTable $Index
 * @property \App\Controller\Component\EchartComponent $Echart       
 */
class SavantChartController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        //待处理专家认证个数
    }
    
    /**
     * 专家认证统计
     */
    public function getAuthChart(){
        $date = $this->request->query('date');
        $date = date('Y-m-d H:i:s',  strtotime($date));
        $type = $this->request->query('type');
        $connection = \Cake\Datasource\ConnectionManager::get('default');
        if($type=='month'){
            $sql = "select count(u.id) as nums,day(u.create_time) as time_item,date(u.create_time) as date
                            from `savant_apply` u where month(u.create_time) = month('".$date."')
                            group by date(u.create_time)";
            $name = date('n',  strtotime($date)).'月';
        }
        if($type=='year'){
            $sql = "select count(u.id) as nums,month(u.create_time) as time_item
                            from `savant_apply` u where year(u.create_time) = year('".$date."')
                            group by month(u.create_time)";
            $name = date('Y',  strtotime($date)).'年';
        }
        if($type=='week'){
            $sql = "select count(u.id) as nums,weekday(u.create_time) as time_item
                            from `savant_apply` u where week(u.create_time) = week('".$date."')
                            group by weekday(u.create_time)";
            $name = date('Y',  strtotime($date)).'年第'.date('W',  strtotime($date)).'周';
        }
        $result = $connection->execute($sql)->fetchAll('assoc');
        $this->loadComponent('Echart');
        $title['text'] = '会员认证统计';
        echo $this->Echart->setLineChart($result,$type,$name,$title,'个');
        exit();
    }
    
    /**
     * 专家话题统计
     */
    public function getSubjectChart(){
        $date = $this->request->query('date');
        $date = date('Y-m-d H:i:s',  strtotime($date));
        $type = $this->request->query('type');
        $connection = \Cake\Datasource\ConnectionManager::get('default');
        if($type=='month'){
            $sql = "select count(u.id) as nums,day(u.create_time) as time_item,date(u.create_time) as date
                            from `meet_subject` u where month(u.create_time) = month('".$date."')
                            group by date(u.create_time)";
            $name = date('n',  strtotime($date)).'月';
        }
        if($type=='year'){
            $sql = "select count(u.id) as nums,month(u.create_time) as time_item
                            from `meet_subject` u where year(u.create_time) = year('".$date."')
                            group by month(u.create_time)";
            $name = date('Y',  strtotime($date)).'年';
        }
        if($type=='week'){
            $sql = "select count(u.id) as nums,weekday(u.create_time) as time_item
                            from `meet_subject` u where week(u.create_time) = week('".$date."')
                            group by weekday(u.create_time)";
            $name = date('Y',  strtotime($date)).'年第'.date('W',  strtotime($date)).'周';
        }
        $result = $connection->execute($sql)->fetchAll('assoc');
        $this->loadComponent('Echart');
        $title['text'] = '会员话题统计';
        echo $this->Echart->setLineChart($result,$type,$name,$title,'个');
        exit();
    }
    
    /**
     * 专家话题统计
     */
    public function getMeetChart(){
        $date = $this->request->query('date');
        $date = date('Y-m-d H:i:s',  strtotime($date));
        $type = $this->request->query('type');
        $connection = \Cake\Datasource\ConnectionManager::get('default');
        if($type=='month'){
            $sql = "select count(u.id) as nums,day(u.create_time) as time_item,date(u.create_time) as date
                            from `subject_book` u where month(u.create_time) = month('".$date."')
                            group by date(u.create_time)";
            $name = date('n',  strtotime($date)).'月';
        }
        if($type=='year'){
            $sql = "select count(u.id) as nums,month(u.create_time) as time_item
                            from `subject_book` u where year(u.create_time) = year('".$date."')
                            group by month(u.create_time)";
            $name = date('Y',  strtotime($date)).'年';
        }
        if($type=='week'){
            $sql = "select count(u.id) as nums,weekday(u.create_time) as time_item
                            from `subject_book` u where week(u.create_time) = week('".$date."')
                            group by weekday(u.create_time)";
            $name = date('Y',  strtotime($date)).'年第'.date('W',  strtotime($date)).'周';
        }
        $result = $connection->execute($sql)->fetchAll('assoc');
        $this->loadComponent('Echart');
        $title['text'] = '会员约见统计';
        echo $this->Echart->setLineChart($result,$type,$name,$title,'个');
        exit();
    }
    

}
