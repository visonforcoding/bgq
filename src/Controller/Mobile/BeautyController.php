<?php

/**
 * @date : 2016-9-14
 * @author : Wash Cai <1020183302@qq.com>
 */

namespace App\Controller\Mobile;

use Wpadmin\Utils\Util;
use PhpParser\Node\Stmt\Switch_;
use App\Controller\Mobile\AppController;
/**
 * Beauty Controller  选美活动
 *
 * @property \App\Model\Table\ActivityTable $Activity
 * @property \App\Controller\Component\BusinessComponent $Business
 * @property \App\Controller\Component\PushComponent $Push
 */
class BeautyController extends AppController {
    
    protected $limit = '10';

    /**
     * 选美活动首页
     */
    public function index(){
        $user = '';
        if($this->user){
            $BeautyTable = \Cake\ORM\TableRegistry::get('beauty');
            $user = $BeautyTable->find()->where(['user_id'=>$this->user->id])->first();
        }
        
        $this->set([
            'pageTitle' => '选美活动',
            'user' => $user
        ]);
    }
    
    /**
     * ajax获取选美活动首页票数前10的选手
     */
    public function getTopUser(){
        $BeautyTable = \Cake\ORM\TableRegistry::get('beauty');
        $UserTable = \Cake\ORM\TableRegistry::get('user');
        $user_id = '';
        if($this->user){
            $user_id = $this->user->id;
            $user = $UserTable->get($user_id);
            $beauty = $BeautyTable
                    ->find()
                    ->contain(['Users'=>function($q){
                        return $q->where(['enabled'=>1]);
                    }, 'Votes'=>function($q)use($user_id){
                        return $q->where(['Votes.user_id'=>$user_id]);
                    }, 'BeautyPics'=>function($q){
                        return $q->limit(1)->orderDesc('BeautyPics.create_time');
                    }])
                    ->where(['is_pass'=>1])
                    ->limit(10)
                    ->orderDesc('vote_nums')
                    ->formatResults(function($items){
                        return $items->map(function($item) {
                            if($item->vote){
                                $items->vote->create_time = $items->vote->create_time->format('Y-m-d');
                            }
                            if(strlen($item->id) == 1){
                                $item->beauty_id = '00' . $item->id;
                            } else if(strlen($items->id) == 2){
                                $item->beauty_id = '0' . $item->id;
                            }
                            return $item;
                        });
                    })
                    ->toArray();
            $now = \Cake\I18n\Time::now();
            $today = $now->format('Y-m-d');
            if($user->is_judge == 1){

            } else {
                foreach($beauty as $k=>$v){
                    if($v->create_time == $today){
                        $beauty[$k]->vote = false;
                    } else {
                        $beauty[$k]->vote = true;
                    }
                }
            }
        } else {
            $beauty = $BeautyTable
                    ->find()
                    ->contain(['Users'=>function($q){
                        return $q->where(['enabled'=>1]);
                    }])
                    ->where(['is_pass'=>1])
                    ->limit(10)
                    ->orderDesc('vote_nums')
                    ->toArray();
        }
        return $this->Util->ajaxReturn(['status'=>true, 'data'=>$beauty]);
    }
    
    /**
     * 搜索
     */
    public function search(){
        $this->set([
            'pageTitle' => '搜索',
        ]);
    }
    
    /**
     * 搜索结果
     * @param int $page 分页
     */
    public function getSearchRes($page){
        $keyword = $this->request->data('keyword');
        $BeautyTable = \Cake\ORM\TableRegistry::get('beauty');
        $user = $BeautyTable
                    ->find()
                    ->contain(['Users'=>function($q)use($keyword){
                        return $q->where(['Users.truename like'=>"%$keyword%", 'enabled'=>1]);
                    }])
                    ->where(['is_pass'=>1])
                    ->page($page, $this->limit)
                    ->toArray();
        if($user){
            return $this->Util->ajaxReturn(['status'=>true, 'data'=>$user]);
        } else if($user == []){
            return $this->Util->ajaxReturn(false, '暂无搜索结果');
        } else {
            return $this->Util->ajaxReturn(false, '系统错误');
        }
    }
    
    /**
     * 报名活动和修改报名信息
     */
    public function enroll(){
        $this->handCheckLogin();
        $BeautyTable = \Cake\ORM\TableRegistry::get('beauty');
        $BeautyPicTable = \Cake\ORM\TableRegistry::get('beauty_pic');
        if($this->request->is('post')){
            $data = $this->request->data;
            $beauty = $BeautyTable->find()->where(['user_id'=>$this->user->id])->first();
            if($beauty) {
                
            } else {
                $beauty = $BeautyTable->newEntity();
            }
            $beauty->user_id = $this->user->id;
            $beauty->constellation = $data['constellation'];
            $beauty->brief = $data['brief'];
            $beauty->declaration = $data['declaration'];
            $beauty->hobby = $data['hobby'];
            $res = $BeautyTable->save($beauty);
            if($res){
                return $this->Util->ajaxReturn(true, '提交成功');
            } else {
                return $this->Util->ajaxReturn(false, '系统错误');
            }
        }
        $user = $BeautyTable->find()->contain(['Users'=>function($q){
            return $q->where(['enabled'=>1]);
        }])->where(['user_id'=>$this->user->id])->first();
        $pic = $BeautyPicTable->find()->where(['user_id'=>$this->user->id])->orderDesc('create_time')->toArray();
        if($user){
            $is_apply = true;
        } else {
            $is_apply = false;
            $UserTable = \Cake\ORM\TableRegistry::get('user');
            $user = $UserTable->get($this->user->id);
        }
        $this->set([
            'pageTitle' => '报名',
            'user' => $user,
            'pic' => $pic,
            'is_apply' => $is_apply
        ]);
    }
    
    /**
     * 我要投票
     * @param int $id 用户id
     */
    public function wantVote($id=null){
        $this->set([
            'pageTitle' => '我要投票',
        ]);
    }
    
    /**
     * 投票动作
     * @param int $id 投票对象id
     */
    public function vote($id=null){
        $this->handCheckLogin();
        $user_id = $this->user->id;
        $VoteTable = \Cake\ORM\TableRegistry::get('vote');
        $UserTable = \Cake\ORM\TableRegistry::get('user');
        $BeautyTable = \Cake\ORM\TableRegistry::get('beauty');
        $vote_user = $UserTable->get($id);
        $last_vote = $VoteTable->find()
                ->contain(['Users'])
                ->where(['user_id'=>$user_id, 'vote_user_id'=>$id])
                ->order('Vote.create_time')->first();
        if($last_vote){
            // 有投票记录
            if($last_vote->user->is_judge == 1){
                // 投票人是评委不可再投票
                return $this->Util->ajaxReturn(false, '您已经投过票了');
            } else {
                // 不是评委比对时间，y-m-d日期不同就可以投票
                $now = \Cake\I18n\Time::now();
                $today = $now->format('Y-m-d');
                if($last_vote->create_time->format('Y-m-d') == $today){
                    return $this->Util->ajaxReturn(false, '您今天已经投过票了');
                }
                $beauty = $BeautyTable->find()->where(['user_id'=>$id])->first();
                $beauty->vote_nums += 1;
                $vote = $VoteTable->newEntity();
                $vote->user_id = $user_id;
                $vote->vote_user_id = $id;
                $res = $VoteTable->connection()->transactional(function()use($BeautyTable, $beauty, $VoteTable, $vote){
                    return $BeautyTable->save($beauty) && $VoteTable->save($vote);
                });
                if($res){
                    return $this->Util->ajaxReturn(true, '投票成功');
                } else {
                    return $this->Util->ajaxReturn(false, '投票失败');
                }
            }
        } else {
            // 无投票记录查找最新一个投票记录
            $user = $UserTable->get($user_id);
            $last_vote = $VoteTable
                    ->find()
                    ->contain(['Users'=>function($q)use($vote_user){
                        return $q->where(['enabled'=>1, 'gender'=>$vote_user->gender]);
                    }])
                    ->where(['user_id'=>$user_id])
                    ->orderDesc('Vote.create_time')
                    ->first();
            if($last_vote){
                $now = \Cake\I18n\Time::now();
                $today = $now->format('Y-m-d');
                if($last_vote->create_time->format('Y-m-d') == $today){
                    return $this->Util->ajaxReturn(false, '您今天已经投过票了');
                }
            }
            $beauty = $BeautyTable->find()->where(['user_id'=>$id])->first();
            $beauty->vote_nums += 1;
            $vote = $VoteTable->newEntity();
            $vote->user_id = $user_id;
            $vote->vote_user_id = $id;
            $res = $VoteTable->connection()->transactional(function()use($VoteTable, $vote, $BeautyTable, $beauty){
                return $VoteTable->save($vote) && $BeautyTable->save($beauty);
            });
            if($res){
                return $this->Util->ajaxReturn(true, '投票成功');
            } else {
                return $this->Util->ajaxReturn(false, '投票失败');
            }
        }
    }
    
    /**
     * 报名信息
     */
    public function userinfo(){
        $this->handCheckLogin();
        $BeautyTable = \Cake\ORM\TableRegistry::get('beauty');
        $beauty = $BeautyTable
                ->find()
                ->contain(['Users'=>function($q){
                    return $q->where(['enabled'=>1]);
                }])
                ->where(['user_id'=>$this->user->id])
                ->first();
        $this->set([
            'pageTitle' => '报名信息',
            'beauty' => $beauty,
        ]);
    }
    
    /**
     * ajax获取女神前十
     */
    public function getFemaleBeauty(){
        $BeautyTable = \Cake\ORM\TableRegistry::get('beauty');
        $female = $BeautyTable->find()
                ->contain(['Users'=>function($q){
                    return $q->where(['enabled'=>1, 'gender'=>2]);
                }, 'BeautyPics'=>function($q){
                    return $q->limit(1)->orderDesc('BeautyPics.create_time');
                }])
                ->where(['is_pass'=>1])
                ->limit(10)
                ->orderDesc('vote_nums')
                ->formatResults(function($items){
                    return $items->map(function($item) {
                        if($item->vote){
                            $items->vote->create_time = $items->vote->create_time->format('Y-m-d');
                        }
                        if(strlen($item->id) == 1){
                            $item->beauty_id = '00' . $item->id;
                        } else if(strlen($items->id) == 2){
                            $item->beauty_id = '0' . $item->id;
                        }
                        return $item;
                    });
                })
                ->toArray();
        if($female){
            return $this->Util->ajaxReturn(['status'=>true, 'data'=>$female]);
        } else if($female == []){
            return $this->Util->ajaxReturn(false, '暂无女神');
        } else {
            return $this->Util->ajaxReturn(false, '系统错误');
        }
    }
    
    /**
     * ajax获取男神前10
     */
    public function getMaleBeauty(){
        $BeautyTable = \Cake\ORM\TableRegistry::get('beauty');
        $male = $BeautyTable->find()
                ->contain(['Users'=>function($q){
                    return $q->where(['enabled'=>1, 'gender'=>1]);
                }, 'BeautyPics'=>function($q){
                    return $q->limit(1)->orderDesc('BeautyPics.create_time');
                }])
                ->where(['is_pass'=>1])
                ->limit(10)
                ->orderDesc('vote_nums')
                ->formatResults(function($items){
                    return $items->map(function($item) {
                        if($item->vote){
                            $items->vote->create_time = $items->vote->create_time->format('Y-m-d');
                        }
                        if(strlen($item->id) == 1){
                            $item->beauty_id = '00' . $item->id;
                        } else if(strlen($items->id) == 2){
                            $item->beauty_id = '0' . $item->id;
                        }
                        return $item;
                    });
                })
                ->toArray();
        if($male){
            return $this->Util->ajaxReturn(['status'=>true, 'data'=>$male]);
        } else if($male == []){
            return $this->Util->ajaxReturn(false, '暂无男神');
        } else {
            return $this->Util->ajaxReturn(false, '系统错误');
        }
    }
    
    /**
     * 个人主页
     */
    public function homepage($id=null){
        $self = false;
        if($this->user){
            if($id ==$this->user->id){
                $self = true;
            }
        }
        if(empty($id)){
            //自己看自己的
            $this->handCheckLogin();
            $id = $this->user->id;
            $self = true;
        }
        $BeautyTable = \Cake\ORM\TableRegistry::get('beauty');
        $beauty = $BeautyTable->find()
                ->contain(['Users'=>function($q){
                    return $q->where(['enabled'=>1]);
                }])
                ->where(['is_pass'=>1, 'Beauty.id'=>$id])
                ->formatResults(function($items) {
                    return $items->map(function($item) {
                        $item->user->avatar = getSmallAvatar($item->user->avatar);
                        if(strlen($item->id) == 1){
                            $item->beauty_id = '00' . $item->id;
                        } else if(strlen($items->id) == 2){
                            $item->beauty_id = '0' . $item->id;
                        }
                        return $item;
                    });
                })
                ->first();
        $rank = $BeautyTable->find()
                ->contain(['Users'=>function($q){
                    return $q->where(['enabled'=>1]);
                }])
                ->where(['is_pass'=>1, 'Beauty.id'=>$id, 'vote_nums >='=>$beauty->vote_nums])
                ->count();
//        debug($beauty);die;
        $this->set([
            'pageTitle' => $beauty->user->truename . '的选美主页',
            'beauty' => $beauty,
            'rank' => $rank,
            'self' => $self,
        ]);
    }
    
    /**
     * 微信上传图片
     * @param int $id 微信上传图片id
     */
    public function getWxPic($id=''){
        $this->handCheckLogin();
        $this->loadComponent('Wx');
        $token = $this->Wx->getAccessToken();
        $url = 'http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=' . $token . '&media_id=' . $id;
        $httpClient = new \Cake\Network\Http\Client();
        $response = $httpClient->get($url);
        if($response->isOk()){
            $res = $response->body();
        }
        \Cake\Log\Log::debug($res,'devlog');
        $today = date('Y-m-d');
        $path = 'upload/beauty/pic/'.$today;
        $file_name = uniqid().'.jpg';
        if(!is_dir($path)){
            mkdir($path,0777,true);
        }
        $img = \Intervention\Image\ImageManagerStatic::make($res)
                ->save(WWW_ROOT . $path . '/' . $file_name);
        $image = getimagesize(WWW_ROOT . $path . '/' . $file_name);
        if ($image === false){
            return $this->Util->ajaxReturn(false, '系统错误');
        }
        \Intervention\Image\ImageManagerStatic::make($res)
                ->resize(intval($image[0]*0.4), intval($image[1]*0.4))
                ->save(WWW_ROOT . $path . '/small_' . $file_name);
        \Intervention\Image\ImageManagerStatic::make($res)
                ->resize(60, 60)
                ->save(WWW_ROOT . $path . '/thumb_' . $file_name);
        $file_name = '/' . $path . '/small_' . $file_name;
        $BeautyPicTable = \Cake\ORM\TableRegistry::get('beauty_pic');
        $pic = $BeautyPicTable->newEntity();
        $pic->user_id = $this->user->id;
        $pic->pic_url = $file_name;
        $res = $BeautyPicTable->save($pic);
        if($res){
            return $this->Util->ajaxReturn(['status'=>true, 'msg'=>'照片上传成功', 'smallpath'=>$file_name]);
        } else {
            return $this->Util->ajaxReturn(false, '照片上传失败');
        }
    }

    /**
     * app上传照片
     */
    public function getAppPic(){
        $this->handCheckLogin();
        $data = $this->request->data;
        $BeautyPicTable = \Cake\ORM\TableRegistry::get('beauty_pic');
        $pic = $BeautyPicTable->newEntity();
        $pic->user_id = $this->user->id;
        $pic->pic_url = $data['url'];
        $res = $BeautyPicTable->save($pic);
        if ($res) {
            return $this->Util->ajaxReturn(['status'=>true, 'msg'=>'照片上传成功', 'data'=>$res]);
        } else {
            return $this->Util->ajaxReturn(false, '照片上传失败');
        }
    }
    
    public function delPic($id=null){
        if(empty($id)){
            return $this->Util->ajaxReturn(false, '请选择一张照片');
        }
        $BeautyPicTable = \Cake\ORM\TableRegistry::get('beauty_pic');
        $pic = $BeautyPicTable->get($id);
        $res = $BeautyPicTable->delete($pic);
        if($res){
            return $this->Util->ajaxReturn(true, '删除成功');
        } else {
            return $this->Util->ajaxReturn(false, '删除失败');
        }
    }
}