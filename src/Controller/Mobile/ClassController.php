<?php

/**
 * @date : 2016-12-20
 * @author : Wash Cai <1020183302@qq.com>
 */

namespace App\Controller\Mobile;

use Wpadmin\Utils\Util;
use PhpParser\Node\Stmt\Switch_;
use App\Controller\Mobile\AppController;
/**
 * Course Controller  课程
 *
 * @property \App\Model\Table\ClassTable $Class
 * @property \App\Controller\Component\BusinessComponent $Business
 * @property \App\Controller\Component\PushComponent $Push
 */
class ClassController extends AppController {
    
    public function detail($id=NULL){
        $this->handCheckLogin();
        $user_id = $this->user->id;
        $ClassTable = \Cake\ORM\TableRegistry::get('Class');
        $class = $ClassTable->get($id, [
            'contain' => [
                'Mentors'=>function($q){
                    return $q->where(['Mentors.is_del'=>0]);
                }, 'ClassPics'=>function($q){
                    return $q->order(['ClassPics.sort'=>'asc']);
                }
            ],
            'conditions'=>['Class.is_del'=>0]
        ]);
        if($class->is_free){
            
        } else {
            $res = $ClassTable->find()->contain(['Courses'=>function($q){
                return $q->where(['Courses.is_del'=>0]);
            }, 'Courses.CourseApplies'=>function($q)use($user_id){
                return $q->where(['CourseApplies.is_pay'=>1, 'user_id'=>$user_id]);
            }])->where(['Class.is_del'=>0])->toArray();
        }
        $ClassLearnTable = \Cake\ORM\TableRegistry::get('ClassLearn');
        $classLearn = $ClassLearnTable->find()->where(['class_id'=>$id, 'uid'=>$user_id])->first();
        if(!$classLearn){
            $learn = $ClassLearnTable->newEntity([
                'class_id' => $id,
                'uid' => $user_id
            ]);
            $ClassLearnTable->save($learn);
        }
//        debug($class);die;
        $this->set([
            'pageTitle' => $class->title,
            'class' => $class
        ]);
    }
}