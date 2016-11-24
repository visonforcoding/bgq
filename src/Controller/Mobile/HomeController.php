<?php

namespace App\Controller\Mobile;

use App\Controller\Mobile\AppController;
use Cake\I18n\Time;

/**
 * Home Controller  个人中心
 *
 * @property \App\Model\Table\HomeTable $Home
 * @property \App\Model\Table\UserTable $User
 * @property \App\Controller\Component\BusinessComponent $Business
 * @property \App\Controller\Component\PushComponent $Push
 * @property \App\Controller\Component\WxComponent $Wx
 * @property \App\Controller\Component\WxpayComponent $Wxpay
 * @property \App\Controller\Component\SmsComponent $Sms
 */
class HomeController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadModel('User');
    }

    protected $limit = '10'; // 分页条数

    /**
     * Index method  个人中心页
     *
     * @return \Cake\Network\Response|null
     */

    public function index() {
        $user_id = '';
        if($this->user){
            $user_id = $this->user->id;
        }
//        $user = $this->User->get($user_id);
        $isWx = $this->request->is('weixin') ? true : false;
//        $UsermsgTable = \Cake\ORM\TableRegistry::get('Usermsg');
//        $unReadFollowCount = $UsermsgTable->find()->where(['user_id' => $user_id, 'status' => 0, 'type' => 1])->count(); //未读关注消息
//        $unReadSysCount = $UsermsgTable->find()->where(['user_id' => $user_id, 'status' => 0, 'type !=' => 1])->count(); //未读系统消息
//        $hasMsg = false;
//        if ($unReadFollowCount || $unReadSysCount) {
//            $hasMsg = true;
//        }
        $this->set([
            'user_id' => $user_id,
            'isWx' => $isWx,
//            'hasMsg'=>$hasMsg,
            'pageTitle' => '个人中心',
        ]);
    }
    
    /**
     * 个人中心拉取数据
     */
    public function getUserinfo(){
        $this->handCheckLogin();
        $user_id = $this->user->id;
        $user = $this->User->get($user_id, [
            'fields' => ['id', 'truename', 'avatar', 'company', 'position', 'level']
        ]);
        $user->avatar = getOriginAvatar($user->avatar);
        $isWx = $this->request->is('weixin') ? true : false;
        $UsermsgTable = \Cake\ORM\TableRegistry::get('Usermsg');
        $BookChatTable = \Cake\ORM\TableRegistry::get('book_chat');
        $unReadFollowCount = $UsermsgTable->find()->where(['user_id' => $user_id, 'status' => 0, 'type' => 1])->count(); //未读关注消息
        $unReadSysCount = $UsermsgTable->find()->where(['user_id' => $user_id, 'status' => 0, 'type !=' => 1])->count(); //未读系统消息
        $hasMsg = false;
        if ($unReadFollowCount || $unReadSysCount) {
            $hasMsg = true;
        }
        $unReadActivity = $UsermsgTable->find()->contain(['Activities'=>function($q){
            return $q->where(['Activities.status'=>1]);
        }])->where(['Usermsg.user_id'=>$user_id, 'Usermsg.status'=>0, 'type'=>7])->count();
        $activityMsg = false;
        if($unReadActivity){
            $activityMsg = true;
        }
        $unReadMeet = $UsermsgTable->find()
                ->contain(['SubjectBook','SubjectBook.Subjects'])
                ->where(['Usermsg.user_id'=>$user_id, 'Usermsg.status'=>0, 'Usermsg.type'=>4])
                ->count();
        $unReadChat = $BookChatTable->find()->where(['reply_id'=>$user_id, 'is_read'=>0])->count();
        $meetMsg = false;
        if($unReadMeet || $unReadChat){
            $meetMsg = true;
        }
        $res = compact('user', 'isWx', 'hasMsg', 'activityMsg', 'meetMsg');
        return $this->Util->ajaxReturn(['status'=>true, 'data'=>$res]);
    }

            /**
             * ajax获取我的活动 报名
             */
            public function myActivityApply() {
                $applyTable = \Cake\ORM\TableRegistry::get('activityapply');
//                $UsermsgTable = \Cake\ORM\TableRegistry::get('usermsg');
                $orderTable = \Cake\ORM\TableRegistry::get('order');
                $myActivity = $applyTable->find()->distinct(['activityapply.id'])
                        ->contain(['Activities'=>function($q){
                    return $q->where(['status'=>1, 'is_del'=>0]);
                }, 'Lmorder'=>function($q){
                    return $q->where(['type'=>2]);
                }, 'Usermsg'=>function($q){
                    return $q->where(['Usermsg.status'=>0, 'Usermsg.type'=>7]);
                }])->where(['activityapply.user_id' => $this->user->id])->orderDesc('activityapply.create_time')->toArray();
//                $UsermsgTable->updateAll(['status'=>1], ['user_id'=>$this->user->id, 'status'=>0, 'type'=>7]);
                if ($myActivity !== false) {
                    return $this->Util->ajaxReturn(['status' => true, 'data' => $myActivity]);
                } elseif($myActivity == []){
                    return $this->Util->ajaxReturn(false, '暂无报名活动');
                } else {
                    return $this->Util->ajaxReturn(false, '系统错误');
                }
            }

            /**
             * ajax获取我的发布活动
             */
            public function getMyActivity() {
                $ActivityNeedTable = \Cake\ORM\TableRegistry::get('activityneed');
                $activities = $ActivityNeedTable->findByUserId($this->user->id)->orderDesc('create_time')->toArray();
                if ($activities !== false) {
                    return $this->Util->ajaxReturn(['status' => true, 'data' => $activities]);
                } elseif($activities == []){
                    return $this->Util->ajaxReturn(false, '暂无发布活动');
                } else {
                    return $this->Util->ajaxReturn(false, '系统错误');
                }
            }

            /**
             * 我的活动 发布
             */
            public function myActivitySubmit($type=null) {
                $this->set([
                    'pageTitle' => '我的活动',
                    'type' => $type
                ]);
            }

            /**
             * 实名认证
             */
            public function realnameAuth() {
                $user_id = $this->user->id;
                $user = $this->User->get($user_id);
                if ($this->request->is('post')) {
                    $user = $this->User->patchEntity($user, $this->request->data());
                    $user->status = 1; //实名状态改为未审核
                    if ($this->User->save($user)) {
                        $this->loadComponent('Business');
                        $this->Business->adminmsg(1, $user_id, '您有一条实名认证申请需处理');
                        return $this->Util->ajaxReturn(true, '保存成功');
                    } else {
                        return $this->Util->ajaxReturn(false, '保存失败');
                    }
                }
                $this->set([
                    'pageTitle' => '实名认证'
                ]);
                $this->set(compact('user'));
            }

            /**
             * 专家认证
             */
            public function savantAuth() {
                $this->handCheckLogin();
                
                $user_id = $this->user->id;
                $user = $this->User->get($user_id, ['contain' => ['Savants']]);
                $UserTable = \Cake\ORM\TableRegistry::get('user');
                if ($this->request->is('post')) {
                    $UserTable = \Cake\ORM\TableRegistry::get('user');
                    $user = $UserTable->get($this->user->id, [
                        'contain' => ['Careers', 'Educations', 'Industries']
                    ]);
                    $is_complete = $user->company && $user->gender && $user->position && $user->email && $user->agency_id
                            && $user->industries && $user->city && $user->goodat && $user->gsyw && $user->card_path;
                    if(!$is_complete){
                        return $this->Util->ajaxReturn(false, '请先去完善个人资料');
                    }
                    $SavantTable = \Cake\ORM\TableRegistry::get('savant');
                    $repeat = $SavantTable->find()->where(['user_id' => $user_id])->first();
                    if ($repeat) {
                        $savant = $SavantTable->get($repeat->id);
                        $savant = $SavantTable->patchEntity($savant, $this->request->data());
                    } else {
                        $savant = $SavantTable->newEntity();
                        $savant->user_id = $user_id;
                        $savant = $SavantTable->patchEntity($savant, $this->request->data());
                    }
                    $user->savant_status = 2;
                    $ckRes = $this->User->connection()->transactional(function()use($SavantTable, $savant, $user, $UserTable) {
                        //开启事务
                        return $SavantTable->save($savant) && $UserTable->save($user);
                    });
                    if ($ckRes) {
                        $this->loadComponent('Business');
                        $this->Business->adminmsg(1, $user_id, '您有一条专家认证申请需处理');
                        //新增一条申请记录
                        $ApplyTable = \Cake\ORM\TableRegistry::get('SavantApply');
                        $apply = $ApplyTable->newEntity([
                            'user_id'=>  $user_id,
                            'xmjy'=>  $this->request->data('xmjy'),
                            'zyys'=>  $this->request->data('zyys'),
                        ]);
                        $ApplyTable->save($apply);
                        return $this->Util->ajaxReturn(true, '提交成功');
                    } else {
                        return $this->Util->ajaxReturn(false, errorMsg($savant, '提交失败'));
                    }
                }
                $this->set([
                    'pageTitle' => '会员认证'
                ]);
                $this->set(compact('user'));
            }

            /**
             * 我的关注
             */
            public function myFollowing($type=null) {
                $this->set([
                    'pageTitle' => '我的关注',
                    'type' => $type,
                ]);
            }
            
            /**
             * ajax获取我的关注
             */
            public function getMyFollowing(){
                $user_id = $this->user->id;
                $FansTable = \Cake\ORM\TableRegistry::get('user_fans');
                $followings = $FansTable->find()->contain(['Followings' => function($q) {
                    return $q->select(['id', 'truename', 'company', 'position', 'avatar', 'fans', 'level'])
                            ->where(['enabled' => 1])->contain(['Subjects'=>function($q){
                                return $q->where(['Subjects.is_del'=>0])->orderDesc('Subjects.create_time');
                            }]);
                }])->hydrate(false)
                    ->where(['user_id' => $user_id])
                    ->formatResults(function($items) {
                        return $items->map(function($item) {
                            $item['following']['avatar'] = getSmallAvatar($item['following']['avatar']);
                            return $item;
                        });
                    })
                    ->orderDesc('user_fans.create_time')
                    ->toArray();
                if($followings){
                    return $this->Util->ajaxReturn(['status'=>true, 'data'=>$followings]);
                } else if($followings == []){
                    return $this->Util->ajaxReturn(false, '暂无关注');
                } else {
                    return $this->Util->ajaxReturn(false, '系统错误');
                }
            }

            /**
             * ajax我的粉丝
             */
            public function getMyFans() {
                $user_id = $this->user->id;
                $FansTable = \Cake\ORM\TableRegistry::get('user_fans');
                $fans = $FansTable->find()->contain(['Users' => function($q) {
                        return $q->select(['id', 'truename', 'company', 'position', 'avatar', 'fans', 'level'])
                                ->where('enabled = 1')->contain(['Subjects'=>function($q){
                                    return $q->where(['Subjects.is_del'=>0]);
                                }]);
                    }])->hydrate(false)
                        ->where(['following_id' => $user_id])
                        ->formatResults(function($items) {
                            return $items->map(function($item) {
                                $item['user']['avatar'] = getSmallAvatar($item['user']['avatar']);
                                return $item;
                            });
                        })
                        ->orderDesc('user_fans.update_time')
                        ->toArray();
                if($fans){
                    return $this->Util->ajaxReturn(['status'=>true, 'data'=>$fans]);
                } else if($fans == []){
                    return $this->Util->ajaxReturn(false, '暂无粉丝');
                } else {
                    return $this->Util->ajaxReturn(false, '系统错误');
                }
            }

            /**
             * 我的关注消息
             */
            public function myMessageFans($type=null) {
                //查找type 为1 的消息
                $user_id = $this->user->id;
                $UsermsgTable = \Cake\ORM\TableRegistry::get('usermsg');
//                $unReadFollowCount = $UsermsgTable->find()->where(['user_id' => $user_id, 'status' => 0, 'type' => 1])->count(); //未读关注消息
                $unReadFollowCount = $UsermsgTable->find()
                                ->hydrate(false)
                                ->distinct('u.id')
                                ->select(['u.truename', 'u.avatar', 'u.id', 'usermsg.create_time',
                                    'u.company', 'u.position', 'u.fans', 'uf.type', 'u.level'])
                                ->join([
                                    'uf' => [
                                        'table' => 'user_fans',
                                        'type' => 'inner',
                                        'conditions' => 'uf.id = usermsg.table_id',
                                    ],
                                    'u' => [
                                        'table' => 'user',
                                        'type' => 'inner',
                                        'conditions' => 'u.id = uf.user_id',
                                    ]
                                ])
                                ->where(['usermsg.`user_id`' => $user_id, 'usermsg.status'=>0])
                                ->orderDesc('usermsg.update_time')
                                ->formatResults(function($items) {
                                    return $items->map(function($item) {
                                        $item['u']['avatar'] = getSmallAvatar($item['u']['avatar']);
                                        return $item;
                                    });
                                })
                                ->count();
                $unReadSysCount = $UsermsgTable->find()->where(['user_id' => $user_id, 'status' => 0, 'type !=' => 1])->count(); //未读系统消息
                $this->set([
                    'pageTitle' => '关注消息',
                    'unReadSysCount' => $unReadSysCount,
                    'unReadFollowCount' => $unReadFollowCount,
                    'type' => $type
                ]);
            }

            /**
             * ajax获取新的关注
             */
            public function getFansMessage(){
                $user_id = $this->user->id;
                $UsermsgTable = \Cake\ORM\TableRegistry::get('usermsg');
                $fans = $UsermsgTable->find()
                                ->hydrate(false)
                                ->distinct('u.id')
                                ->select(['u.truename', 'u.avatar', 'u.id', 'usermsg.create_time',
                                    'u.company', 'u.position', 'u.fans', 'uf.type', 'u.level'])
                                ->join([
                                    'uf' => [
                                        'table' => 'user_fans',
                                        'type' => 'inner',
                                        'conditions' => 'uf.id = usermsg.table_id',
                                    ],
                                    'u' => [
                                        'table' => 'user',
                                        'type' => 'inner',
                                        'conditions' => 'u.id = uf.user_id',
                                    ]
                                ])
                                ->where(['usermsg.`user_id`' => $user_id, 'usermsg.status'=>0])
                                ->orderDesc('usermsg.create_time')
                                ->formatResults(function($items) {
                                    return $items->map(function($item) {
                                        $item['u']['avatar'] = getSmallAvatar($item['u']['avatar']);
                                        return $item;
                                    });
                                })
                                ->toArray();
                //看了之后 就更改状态了为已读
                $UsermsgTable->updateAll(['status' => 1], ['user_id' => $user_id, 'status' => 0, 'type'=>1]);
                if($fans){
                    return $this->Util->ajaxReturn(['status'=>true, 'data'=>$fans]);
                } elseif($fans == []) {
                    return $this->Util->ajaxReturn(false, '暂无消息');
                } else {
                    return $this->Util->ajaxReturn(false, '系统错误');
                }
            }

            /**
             * 我的系统消息
             */
            public function getSysMessage($page) {
                $user_id = $this->user->id;
                $UsermsgTable = \Cake\ORM\TableRegistry::get('usermsg');
                $msgs = $UsermsgTable->find()
                        ->where(['user_id' => $user_id, 'type !=' => 1])
                        ->order(['status'=>'asc', 'create_time'=>'desc'])
//                        ->page($page, $this->limit)
                        ->toArray();
                if($msgs){
                    return $this->Util->ajaxReturn(['status'=>true, 'data'=>$msgs]);
                } elseif($msgs == []) {
                    return $this->Util->ajaxReturn(false, '暂无消息');
                } else {
                    return $this->Util->ajaxReturn(false, '系统错误');
                }
            }
            
            public function myXiaomi(){
                $this->set([
                    'pageTitle' => '小秘书',
                ]);
            }
            
            /**
             * 获取小秘书的聊天信息
             */
            public function getXiaomi(){
                $this->handCheckLogin();
                if($this->request->is('post')){
                    $NeedTable = \Cake\ORM\TableRegistry::get('need');
                    $where['OR'] = ['reply_id'=>$this->user->id, 'user_id'=>$this->user->id];
                    $res = $NeedTable->find()->where($where)->hydrate(false)->toArray();
                    if(!$res){
                        $res = '';
                    } else {
                        $NeedTable->updateAll(['status'=>1], ['status'=>0, 'reply_id'=>$this->user->id]);
                    }
                    return $this->Util->ajaxReturn(['status'=>true, 'data'=>$res]);
                }
            }

        /**
         * 回复小秘书
         */
        public function replyXiaomi() {
            if ($this->request->is('post')) {
//                $UserTable = \Cake\ORM\TableRegistry::get('user');
//                $user = $UserTable->get($this->user->id, [
//                    'contain' => ['Careers', 'Educations', 'Industries']
//                ]);
//                $is_complete = $user->company && $user->gender && $user->position && $user->email && $user->agency_id
//                        && $user->industries && $user->city && $user->goodat && $user->gsyw && $user->card_path;
//                if(!$is_complete){
//                    return $this->Util->ajaxReturn(false, '请先去完善个人资料');
//                }
                $user_id = $this->user->id;
                $NeedTable = \Cake\ORM\TableRegistry::get('need');
                $content = $this->request->data('content');
                \Cake\Log\Log::debug(json_encode($content),'devlog');
                \Cake\Log\Log::debug($_POST['content'],'devlog');
                $need = $NeedTable->newEntity(['user_id' => $user_id, 'msg' => $content]);
                if ($NeedTable->save($need)) {
                    return $this->Util->ajaxReturn(true, '提交成功');
                } else {

                    return $this->Util->ajaxReturn(false, '提交失败');
                }
            }
        }

        /**
         * 小秘书历史记录
         */
        public function myHistoryNeed() {
            $NeedTable = \Cake\ORM\TableRegistry::get('need');
            $user_id = $this->user->id;
            $needs = $NeedTable->find()->where(['user_id' => $user_id])->orWhere(['reply_id' => $user_id])->orderDesc('create_time')->toArray();
            $this->set([
                'pageTitle' => '小秘书历史记录'
            ]);
            $this->set(compact('needs'));
        }

        /**
         * 活动收藏记录
         */
        public function myCollectActivity() {
            $this->set(['pageTitle' => '我的收藏']);
        }

        /**
         * ajax获取我收藏的活动
         */
        public function getMyCollectActivity(){
            $collectTable = \Cake\ORM\TableRegistry::get('collect');
            $activity = $collectTable
                    ->find()
                    ->where(['type' => 0, 'is_delete' => 0, 'collect.user_id' => $this->user->id])
                    ->contain(['Activities'=>function($q){
                        return $q->where(['Activities.is_del'=>0]);
                    }])
                    ->formatResults(function($items) {
                        return $items->map(function($item) {
                            $item->create_time = $item->create_time->format('Y-m-d');
                            return $item;
                        });
                    })
                    ->toArray();
            if($activity){
                return $this->Util->ajaxReturn(['status'=>true, 'data'=>$activity]);
            } else if($activity == []){
                return $this->Util->ajaxReturn(false ,'暂无活动收藏');
            } else {
                return $this->Util->ajaxReturn(false, '系统错误');
            }
        }


        /**
         * 资讯收藏
         */
        public function getMyCollectNews() {
            $user_id = $this->user->id;
            $CollectTable = \Cake\ORM\TableRegistry::get('Collect');
            $collects = $CollectTable->find()->hydrate(false)
                ->contain(['News'=>function($q){
                    return $q->where(['News.is_delete' => 0]);
                }, 'News.Users'=>function($q){
                    return $q->where(['Users.enabled'=>1]);
                }])
                ->where(['Collect.is_delete' => 0, 'Collect.user_id' => $user_id])
                ->orderDesc('Collect.create_time')
                ->formatResults(function($items) {
                    return $items->map(function($item) {
                        //时间语义化转换
                        $item['create_time'] = $item['create_time']->format('Y-m-d');
                        return $item;
                    });
                })
                ->toArray();
            if($collects){
                return $this->Util->ajaxReturn(['status'=>true, 'data'=>$collects]);
            } else if($collects == []){
                return $this->Util->ajaxReturn(false, '暂无资讯收藏');
            } else {
                return $this->Util->ajaxReturn(false, '系统错误');
            }
        }

        /**
         * 我的约见 （我是顾客）
         */
        public function myBook() {
            $savant_nocomfirm = 0;
            $savant_comfirm = 0;
            $savant_nopass = 0;
            $book_nocomfirm = 0;
            $book_comfirm = 0;
            $book_nopass = 0;
            $BookTable = \Cake\ORM\TableRegistry::get('SubjectBook');
            $UsermsgTable = \Cake\ORM\TableRegistry::get('usermsg');
            $type = $this->request->query('type');
            $user_id = $this->user->id;
            $books = $BookTable->find()->contain(['Subjects', 'Subjects.User' => function($q) {
                return $q->where(['enabled'=>1])
                        ->select(['truename', 'avatar', 'id', 'company', 'position', 'meet_nums', 'level']);
            }, 'Usermsgs'=>function($q)use($user_id){
                return $q->where(['Usermsgs.type'=>4, 'Usermsgs.status'=>0, 'Usermsgs.user_id'=>$user_id]);
            }, 'BookChats'=>function($q)use($user_id){
                return $q->where(['reply_id'=>$user_id, 'is_read'=>0]);
            }])->where(['SubjectBook.user_id'=>$user_id, 'SubjectBook.status >'=>'-1'])->order(['SubjectBook.update_time'=>'desc'])->toArray();
            foreach($books as $k=>$v){
                if($v->status == 0){
                    if($v->usermsgs){
                        $book_nocomfirm += 1;
                    }
                } elseif($v->status == 1){
                    if($v->usermsgs || $v->book_chats){
                        $book_comfirm += 1;
                    }
                } elseif($v->status == 2){
                    if($v->usermsgs){
                        $book_nopass += 1;
                    }
                }
            }
            $savant_books = $BookTable->find()->contain(['Subjects', 'Users' => function($q) {
                return $q->where(['Users.enabled'=>1])
                        ->select(['truename', 'avatar', 'id', 'company', 'position', 'meet_nums', 'level']);
            }, 'Usermsgs'=>function($q)use($user_id){
                return $q->where(['Usermsgs.type'=>4, 'Usermsgs.status'=>0, 'Usermsgs.user_id'=>$user_id]);
            }, 'BookChats'=>function($q)use($user_id){
                return $q->where(['reply_id'=>$user_id, 'is_read'=>0]);
            }])->where(['SubjectBook.savant_id =' => $user_id,  'SubjectBook.status >'=>'-1'])->order(['SubjectBook.update_time'=>'desc'])->toArray();
            foreach($savant_books as $k=>$v){
                if($v->status == 0){
                    if($v->usermsgs){
                        $savant_nocomfirm += 1;
                    }
                } elseif($v->status == 1){
                    if($v->usermsgs || $v->book_chats){
                        $savant_comfirm += 1;
                    }
                } elseif($v->status == 2){
                    if($v->usermsgs){
                        $savant_nopass += 1;
                    }
                }
            }
            $my_meet = $book_nocomfirm + $book_comfirm + $book_nopass;
            $meet_me = $savant_comfirm + $savant_nocomfirm + $savant_nopass;
            $this->set([
                'pageTitle' => '我的约见',
                'books' => $books,
                'savant_books' => $savant_books,   //我是专家
                'savant_nocomfirm'=>$savant_nocomfirm,
                'savant_comfirm'=>$savant_comfirm,
                'savant_nopass'=>$savant_nopass,
                'book_nocomfirm'=>$book_nocomfirm,
                'book_comfirm'=>$book_comfirm,
                'book_nopass'=>$book_nopass,
                'my_meet' => $my_meet,
                'meet_me' => $meet_me,
            ]);
            $this->set(compact('books', 'type'));
        }

    /**
     * 我的约见 我是顾客的详情
     */
    public function myBookDetail($id = null) {
        $BookTable = \Cake\ORM\TableRegistry::get('SubjectBook');
        $book = $BookTable->get($id, [
            'contain' => ['Users' => function($q) {
                    return $q->where(['enabled'=>1, 'Users.is_del'=>0])->select(['truename', 'id', 'avatar', 'company', 'position']);
                }, 'Subjects', 'Lmorder']
                ]);
                $subject = $book->subject;
                $this->set(compact('subject', 'book'));
                $this->set('pageTitle', '我是顾客');
            }
            
            /**
             * 取消预约
             * @param int $id
             */
            public function cancelMeeting($id){
                $BookTable = \Cake\ORM\TableRegistry::get('SubjectBook');
                $book = $BookTable->get($id);
                $book->status = -1;
                $res = $BookTable->save($book);
                $this->loadComponent('Business');
                $this->Business->usermsg($book->user_id, '话题预约', '您预约的话题状态更新了', 11, $book->id, '/home/my-book/#3');
                if($res){
                    return $this->Util->ajaxReturn(true, '取消预约成功');
                } else {
                    return $this->Util->ajaxReturn(false, '操作失败');
                }
            }
            
            public function changeSubjectStatus($id){
                $BookTable = \Cake\ORM\TableRegistry::get('SubjectBook');
                $book = $BookTable->get($id);
                $book->is_done = 1;
                $res = $BookTable->save($book);
                if($res){
                    return $this->Util->ajaxReturn(true, '操作成功');
                } else {
                    return $this->Util->ajaxReturn(false, '操作失败');
                }
            }


            /**
             * 我的约见 (我是专家)
             */
            public function myBookSavant() {
                $BookTable = \Cake\ORM\TableRegistry::get('SubjectBook');
                $type = $this->request->query('type');
                $where['SubjectBook.status'] = in_array($type, ['0', '1', '3']) ? $type : 0;
                $where['SubjectBook.savant_id'] = $this->user->id;
                $books = $BookTable->find()->contain(['Subjects', 'Users' => function($q) {
                                return $q->where(['enabled'=>1, 'Users.is_del'=>0])->select(['truename', 'avatar', 'id', 'company', 'position']);
                            }])->where($where)->orderDesc('SubjectBook.update_time')->toArray();
                        $this->set(compact('books', 'type'));
                        $this->set('pageTitle', '我是专家');
                    }

    /**
     * 我的约见 我是专家详情
     * @param type $id
     */
    public function myBookSavantDetail($id = null) {
        $BookTable = \Cake\ORM\TableRegistry::get('SubjectBook');

        $book = $BookTable->get($id, [
            'contain' => ['Users' => function($q) {
                    return $q->where(['enabled'=>1, 'Users.is_del'=>0])->select(['truename', 'id', 'avatar', 'company', 'position', 'phone', 'email']);
                }, 'Subjects', 'Users.Industries']
                ]);
                $subject = $book->subject;
                $industries = $book->user->industries;
                $industries_arr = [];
                foreach ($industries as $industry) {
                    $industries_arr[] = $industry->name;
                }
                if (!empty($book->user->ext_industry)) {
                    $industries_arr[] = $book->user->ext_industry;
                }
                $industries_str = implode('、', $industries_arr);
                $this->set([
                    'pageTitle' => '预约详情',
                    'industries_str' => $industries_str
                ]);
                $this->set(compact('subject', 'book'));
    }

    /**
     * 同意约见 约见状态更改->生成一条订单(目前对前台用户暂时没作用)
     */
    public function bookOk() {
        if ($this->request->is('post')) {
            $id = $this->request->data('id'); //book id
            $BookTable = \Cake\ORM\TableRegistry::get('SubjectBook');
            $book = $BookTable->get($id, [
                'contain' => [
                    'Subjects',
                    'Users'=>function($q){
                        return $q->where(['enabled'=>1]);
                    }
                ]
            ]);
            $book->status = 1; //更改
//            $OrderTable = \Cake\ORM\TableRegistry::get('order');
//            $order = $OrderTable->newEntity([
//                'type' => 1,
//                'relate_id' => $id, //预定表的id
//                'user_id' => $book->user_id,
//                'seller_id' => $book->savant_id,
//                'order_no' => time() . $book->user_id . $id . createRandomCode(2, 2),
//                'fee' => 0, // 实际支付的默认值
//                'price' => $book->subject->price,
//                'remark' => '预约话题' . $book->subject->title
//            ]);
//            $transRes = $BookTable->connection()->transactional(function()use($book, $BookTable, $order, $OrderTable) {
//                return $BookTable->save($book) && $OrderTable->save($order);
//            });
            $UserTable = \Cake\ORM\TableRegistry::get('user');
            $savant = $UserTable->get($book->savant_id);
            $savant->meet_nums += 1;
            $UserTable->save($savant);
            $transRes = $BookTable->save($book);
            if ($transRes) {
                //短信和消息通知
                $this->loadComponent('Sms');
                $msg = "您预约的话题：《" . $book->subject->title . "》已确认通过。";
                $this->Sms->sendByQf106($book->user->phone, $msg);
                $this->loadComponent('Business');
                $jump_url = '/home/my-book/#2';
                $this->Business->usermsg($book->user_id, '预约通知', $msg, 4, $id, $jump_url);
                return $this->Util->ajaxReturn(true, '处理成功!');
            } else {
                return $this->Util->ajaxReturn(false, '服务器出错!');
            }
        }
    }

    /**
     * 取消预约
     */

    public function bookNo($id) {
        if ($this->request->is('post')) {
            $BookTable = \Cake\ORM\TableRegistry::get('SubjectBook');
            $book = $BookTable->get($id, [
                'contain' => [
                    'Subjects',
                    'Users'=>function($q){
                        return $q->where(['enabled'=>1]);
                    }
                ]
            ]);
            $book->status = 2;
            if ($BookTable->save($book)) {
                $this->loadComponent('Business');
                $jump_url = '/home/my-book/#3';
                $this->Business->usermsg($book->user_id, '预约通知', '您的预约未被通过', 4, $id, $jump_url);
                return $this->Util->ajaxReturn(true, '操作成功');
            } else {
                return $this->Util->ajaxReturn(false, '操作失败');
            }
        }
    }
    
    /**
     * 约见聊天
     * @param int $book_id 约见id
     * @param int $type 类型，1约见;2被约见
     */
    public function bookChat($book_id, $type=NULL){
        $this->handCheckLogin();
        $uid = $this->user->id;
        $BookTable = \Cake\ORM\TableRegistry::get('SubjectBook');
        $UserTable = \Cake\ORM\TableRegistry::get('User');
        $book = $BookTable->get($book_id, [
            'contain' => ['Subjects']
        ]);
        if($type == 1){
            $user = $UserTable->get($book->savant_id, [
                'fields' => ['id', 'truename', 'avatar']
            ]);
        } else {
            $user = $UserTable->get($book->user_id, [
                'fields' => ['id', 'truename', 'avatar']
            ]);
        }
        $this->set([
            'pageTitle'=>$user->truename,
            'user' => $user,
            'book' => $book,
            'uid' => $uid,
            'type' => $type
        ]);
    }
    
    /**
     * 获得聊天记录
     * @param int $book_id 约见id
     * @param int $type 类型，1约见;2被约见
     */
    public function getChat($book_id){
        $this->handCheckLogin();
        $user_id = $this->user->id;
        $BookTable = \Cake\ORM\TableRegistry::get('SubjectBook');
        $book = $BookTable->get($book_id);
        $bookChatTable = \Cake\ORM\TableRegistry::get('BookChat');  
        $where = [];
        $where['BookChat.user_id in'] = [$book->savant_id, $book->user_id];
        $where['reply_id in'] = [$book->savant_id, $book->user_id];
        $where['book_id'] = $book_id;
        $bookChat = $bookChatTable
                ->find()
                ->where($where)
                ->contain(['Users', 'ReplyUsers', 'SubjectBooks'])
                ->orderDesc('BookChat.create_time')
                ->select(['book_id', 'content', 'id', 'reply_id', 'Users.id', 'Users.avatar', 'BookChat.create_time', 'BookChat.is_show_time'])
                ->formatResults(function($items) {
                    return $items->map(function($item) {
//                        $item->create_time = $item->create_time->timeAgoInWords([
//                            'accuracy' => [
//                                'year' => 'year',
//                                'month' => 'month',
//                                'week' => 'week',
//                                'day' => 'day',
//                                'hour' => 'hour',
//                            ],
//                            'end' => '1 minute'
//                        ]);
                        $item->create_time = $item->create_time->format('m月d日 H:i');
                        return $item;
                    });
                })
                ->toArray();
        if($bookChat !== false){
            $BookChatTable = \Cake\ORM\TableRegistry::get('book_chat');
            $BookChatTable->updateAll(['is_read'=>1], ['reply_id'=>$user_id, 'book_id'=>$book_id, 'is_read'=>0]);
            return $this->Util->ajaxReturn(['status'=>true, 'data'=>$bookChat]);
        } else {
            return $this->Util->ajaxReturn(false, '系统错误');
        }
    }
    /**
     * 获得聊天记录
     * @param int $book_id 约见id
     * @param int $type 类型，1约见;2被约见
     */
    public function getNewChat($book_id, $type){
        $this->handCheckLogin();
        $user_id = $this->user->id;
        $BookTable = \Cake\ORM\TableRegistry::get('SubjectBook');
        $book = $BookTable->get($book_id);
        $bookChatTable = \Cake\ORM\TableRegistry::get('BookChat');  
        $where = [];
        $where['BookChat.user_id in'] = [$book->savant_id, $book->user_id];
//        $where['reply_id in'] = [$book->savant_id, $book->user_id];
        $where['reply_id'] = $user_id;
        $where['book_id'] = $book_id;
        $where['is_read'] = 0;
//        if($type == '1'){
//            $where['BookChat.user_id'] = $book->savant_id;
//        } else {
//            $where['BookChat.user_id'] = $book->user_id;
//        }
        $bookChat = $bookChatTable
                ->find()
                ->where($where)
                ->contain(['Users', 'ReplyUsers', 'SubjectBooks'])
                ->orderDesc('BookChat.create_time')
                ->select(['book_id', 'content', 'id', 'reply_id', 'Users.id', 'Users.avatar', 'BookChat.create_time', 'BookChat.is_show_time'])
//                ->limit($this->limit)
                ->formatResults(function($items) {
                    return $items->map(function($item) {
//                        $item->create_time = $item->create_time->timeAgoInWords([
//                            'accuracy' => [
//                                'year' => 'year',
//                                'month' => 'month',
//                                'week' => 'week',
//                                'day' => 'day',
//                                'hour' => 'hour',
//                                'minute' => 'minute',
//                                'secend' => 'secend'
//                            ],
//                            'end' => '1 minute'
//                        ]);
                        $item->create_time = $item->create_time->format('m月d日 H:i');
                        return $item;
                    });
                })
                ->toArray();
        if($bookChat){
            $BookChatTable = \Cake\ORM\TableRegistry::get('book_chat');
            $BookChatTable->updateAll(['is_read'=>1], ['reply_id'=>$user_id, 'book_id'=>$book_id, 'is_read'=>0]);
            return $this->Util->ajaxReturn(['status'=>true, 'data'=>$bookChat]);
        } else {
            return $this->Util->ajaxReturn(false);
        }
    }
    
    /**
     * 发送消息
     * @param int $book_id 约见id
     * @param int $type 类型，1约见;2被约见
     */
    public function replyChat($book_id, $type){
        $user_id = $this->user->id;
        $BookTable = \Cake\ORM\TableRegistry::get('SubjectBook');
        $bookChatTable = \Cake\ORM\TableRegistry::get('bookChat');
        $book = $BookTable->get($book_id);
        $where = [];
        $where['BookChat.user_id in'] = [$book->savant_id, $book->user_id];
        $where['reply_id in'] = [$book->savant_id, $book->user_id];
        $where['book_id'] = $book_id;
        $last_msg = $bookChatTable
                ->find()
                ->where($where)
                ->orderDesc('BookChat.create_time')
                ->select(['book_id', 'content', 'id', 'reply_id', 'create_time'])
                ->first();
        $now = Time::now();
        if($last_msg){
            if($last_msg->create_time->modify('5 minutes') < $now){
                $data['is_show_time'] = 1;
            }
        } else {
            $data['is_show_time'] = 1;
        }
        
        $data['content'] = $this->request->data('content');
        if($type == '1'){
            $data['reply_id'] = $book->savant_id;
            $extra['url'] = 'http://m.chinamatop.com/home/my-book/#5';
        } else {
            $data['reply_id'] = $book->user_id;
            $extra['url'] = 'http://m.chinamatop.com/home/my-book/#2';
        }
        $data['user_id'] = $user_id;
        $data['book_id'] = $book_id;
        $chat = $bookChatTable->newEntity();
        $chat = $bookChatTable->patchEntity($chat, $data);
        $res = $bookChatTable->save($chat);
        if($res){
            $UserTable = \Cake\ORM\TableRegistry::get('user');
            $user = $UserTable->get($data['reply_id']);
            $me = $UserTable->get($user_id);
            $this->loadComponent('Push');
            $this->Push->sendAlias($user->user_token, $me->truename.'给你发了一条消息', $data['content'], $me->truename.'给你发了一条消息', 'BGB', true, $extra);
            $reply_res = $bookChatTable
                ->find()
                ->where(['bookChat.id'=>$res->id])
                ->contain(['Users', 'ReplyUsers', 'SubjectBooks'])
                ->select(['book_id', 'content', 'id', 'reply_id', 'Users.id', 'Users.avatar', 'create_time', 'is_show_time'])
                ->formatResults(function($items) {
                    return $items->map(function($item) {
                        $item->create_time = $item->create_time->format('m月d日 H:i');
                        return $item;
                    });
                })
                ->toArray();
            return $this->Util->ajaxReturn(['status'=>true, 'msg'=>'发送成功', 'data'=>$reply_res]);
        } else {
            return $this->Util->ajaxReturn(false, '系统错误');
        }
    }
    
    
    /**
     * 我的钱包
     */

    public function myPurse() {
        $user_id = $this->user->id;
        $userInfo = $this->User->get($user_id);
        $FlowTable = \Cake\ORM\TableRegistry::get('Flow');
        $flows = $FlowTable->find()->where(['user_id' => $user_id])->orderDesc('create_time')->toArray();
        $this->set(array(
            'userInfo' => $userInfo,
            'flows' => $flows,
            'pageTitle' => '我的钱包'
        ));
    }

    /**
     * 提现
     */
    public function withdraw() {
        $user_id = $this->user->id;
        $userInfo = $this->User->get($user_id);
        $UserTable = $this->User;
        if ($this->request->isAjax()) {
            $amount = $this->request->data('amount');
            $bank = $this->request->data('bank');
            $cardno = $this->request->data('cardno');
            if ($amount > $userInfo->money) {
                return $this->Util->ajaxReturn(false, '提现金额不能大于钱包余额');
            }
            //生成提现记录 余额扣除 生成流水记录
            $WithdrawTable = \Cake\ORM\TableRegistry::get('Withdraw');
            $withdraw = $WithdrawTable->newEntity([
                'user_id' => $user_id,
                'amount' => $amount,
                'cardno' => $cardno,
                'truename' => $userInfo->truename,
                'bank' => $bank,
            ]);
            $FlowTable = \Cake\ORM\TableRegistry::get('Flow');
            $transRes = $WithdrawTable->connection()->transactional(function()use($UserTable,$userInfo,$FlowTable,$WithdrawTable,$withdraw){
                $preAmount = $userInfo->money;
                $userInfo->money -= $withdraw->amount;
                $withdrawRes = $WithdrawTable->save($withdraw);
                $flow = $FlowTable->newEntity([
                    'user_id'=>$userInfo->id,
                    'type'=>3,
                    'type_msg'=>'提现支出',
                    'income'=>2,
                    'relate_id'=>$withdraw->id,
                    'amount'=>$withdraw->amount,
                    'pre_amount'=>$preAmount,
                    'after_amount'=>$userInfo->money,
                    'status'=>0,
                    'remark'=>'用户提现支出'
                ]);
                \Cake\Log\Log::error($flow->errors(),'devlog');
                return $withdrawRes&&$UserTable->save($userInfo)&&$FlowTable->save($flow);
            });
            if ($transRes) {
                return $this->Util->ajaxReturn(true, '提现申请成功');
            } else {
                //\Cake\Log\Log::error($withdraw->errors());
                return $this->Util->ajaxReturn(false, '提现申请失败');
            }
        }
        $this->set([
            'pageTitle' => '提现'
        ]);
        $this->set(compact('userInfo'));
    }

    /**
     * 提现成功页
     */
    public function withdrawSuccess() {

    }

    /**
     * 隐私设置
     */
    public function mySecret() {
        $ScrectTable = \Cake\ORM\TableRegistry::get('Secret');
        $user_id = $this->user->id;
        $secret = $ScrectTable->findOrCreate(['user_id' => $user_id]);
        if ($this->request->is('post')) {
            $ScrectTable->patchEntity($secret, $this->request->data());
            if ($ScrectTable->save($secret)) {
                return $this->Util->ajaxReturn(true, '修改成功');
            } else {
                return $this->Util->ajaxReturn(false, '修改失败');
            }
        }
        $secretType = \Cake\Core\Configure::read('secretType');
        $this->set([
            'pageTitle' => '隐私策略',
            'secret' => $secret,
            'secretType' => $secretType
        ]);
    }

    /**
     * 设置
     */
    public function myInstall() {
        $this->set([
            'pageTitle' => '设置'
        ]);
    }

    /**
     * 修改个人信息
     */
    public function editUserinfo() {
        $user_id = $this->user->id;
        $user = $this->User->get($user_id, [
            'contain' => ['Educations', 'Careers', 'Industries', 'Agencies']
        ]);
        if ($this->request->is('post')) {
            $data['company'] = $this->request->data('company');
            $data['gender'] = $this->request->data('gender');
            $data['position'] = $this->request->data('position');
            $data['email'] = $this->request->data('email');
            $user = $this->User->patchEntity($user, $data);
            if ($this->User->save($user)) {
                return $this->Util->ajaxReturn(true, '保存成功');
            } else {
                \Cake\Log\Log::error($user->errors(),'devlog');
                return $this->Util->ajaxReturn(false,  errorMsg($user,'保存失败'));
            }
        }
        $this->set([
            'user' => $user,
            'pageTitle' => '编辑个人主页'
        ]);
    }

    /**
     * 擅长业务
     */
    public function myBusiness() {
        $user = $this->User->get($this->user->id);
        if ($this->request->is('post')) {
            $user = $this->User->patchEntity($user, $this->request->data());
            if ($this->User->save($user)) {
                return $this->Util->ajaxReturn(true, '修改成功');
            } else {
                return $this->Util->ajaxReturn(false, '保存失败');
            }
        }
        $this->set([
            'pageTitle' => '擅长业务',
            'user' => $user
        ]);
    }

    /**
     * 公司业务
     * @return type
     */
    public function editCompanyBusiness() {
        $user = $this->User->get($this->user->id);
        if ($this->request->is('post')) {
            $user = $this->User->patchEntity($user, $this->request->data());
            if ($this->User->save($user)) {
                return $this->Util->ajaxReturn(true, '修改成功');
            } else {
                return $this->Util->ajaxReturn(false, '保存失败');
            }
        }
        $this->set([
            'pageTitle' => '公司业务',
            'user' => $user
        ]);
    }

    /**
     * 编辑教育经历
     */
    public function editEducation() {
        $EducationTable = \Cake\ORM\TableRegistry::get('Education');
        $educations = $EducationTable->find()->where(['user_id' => $this->user->id])->toArray();
        $educationType = \Cake\Core\Configure::read('educationType');
        $this->set([
            'pageTitle' => '编辑教育经历',
            'educations' => $educations,
            'educationType' => $educationType
        ]);
    }

    /**
     * 保存教育经历
     */
    public function saveEducation() {
        $EducationTable = \Cake\ORM\TableRegistry::get('Education');
        if ($this->request->is('post')) {
            $data = $this->request->data();
            $start = $data['start_date'];
            $end = $data['end_date'];
            $this->loadComponent('Business');
            $checkDate = $this->Business->checkDate($start, $end);
            if(!$checkDate){
                return $this->Util->ajaxReturn(false, '请选择正确的时间段');
            }
            if (!empty($data['id'])) {
                $education = $EducationTable->get($data['id']);
                if ($education) {
                    $education = $EducationTable->patchEntity($education, $data);
                    $res = $EducationTable->save($education);
                } else {
                    return $this->Util->ajaxReturn(false, '不存在的id');
                }
            } else {
                $data['user_id'] = $this->user->id;
                $education = $EducationTable->newEntity();
                $education = $EducationTable->patchEntity($education, $data);
                $res = $EducationTable->save($education);
            }
            if ($res) {
                return $this->Util->ajaxReturn(['status' => true, 'msg' => '保存成功', 'id' => $res->id]);
            } else {
                return $this->Util->ajaxReturn(false, '保存失败');
            }
        }
    }

    /**
     * 编辑工作经历
     */
    public function editWork() {
        $CareerTable = \Cake\ORM\TableRegistry::get('Career');
        $careers = $CareerTable->find()->where(['user_id' => $this->user->id])->toArray();
        if ($this->request->is('post')) {
            $data = $this->request->data();

            $data['user_id'] = $this->user->id;
            $career = $CareerTable->newEntity($data);
            if ($CareerTable->save($career)) {
                return $this->Util->ajaxReturn(true, '保存成功!');
            } else {
                return $this->Util->ajaxReturn(false, errorMsg($career, '保存失败'));
            }
        }
        $this->set([
            'pageTitle' => '编辑工作经历 ',
            'careers' => $careers
        ]);
    }

    /**
     * 保存工作经历
     */
    public function saveWork() {
        $CareerTable = \Cake\ORM\TableRegistry::get('Career');
        if ($this->request->is('post')) {
            $data = $this->request->data();
            $start = $data['start_date'];
            $end = $data['end_date'];
            $this->loadComponent('Business');
            $checkDate = $this->Business->checkDate($start, $end);
            if(!$checkDate){
                return $this->Util->ajaxReturn(false, '请选择正确的时间段');
            }
            if (!empty($data['id'])) {
                $career = $CareerTable->get($data['id']);
                if ($career) {
                    $career = $CareerTable->patchEntity($career, $data);
                    $res = $CareerTable->save($career);
                } else {
                    return $this->Util->ajaxReturn(false, '不存在的id');
                }
            } else {
                $data['user_id'] = $this->user->id;
                $career = $CareerTable->newEntity();
                $career = $CareerTable->patchEntity($career, $data);
                $res = $CareerTable->save($career);
            }
            if ($res) {
                return $this->Util->ajaxReturn(['status' => true, 'msg' => '保存成功', 'id' => $res->id]);
            } else {
                return $this->Util->ajaxReturn(false, errorMsg($career, '保存失败'));
            }
        }
    }

    /**
     * 删除教育
     * @param type $id
     * @return type
     */
    public function delEducation($id) {
        $EducationTable = \Cake\ORM\TableRegistry::get('Education');
        $education = $EducationTable->find()->where(['user_id' => $this->user->id, 'id' => $id])->first();
        if ($education) {
            if ($EducationTable->delete($education)) {
                return $this->Util->ajaxReturn(true, '删除成功');
            } else {
                return $this->Util->ajaxReturn(false, '删除失败');
            }
        } else {
            return $this->Util->ajaxReturn(false, '记录不存在');
        }
    }

    /**
     * 删除工作经历
     * @param type $id
     * @return type
     */
    public function delWork($id) {
        $CareerTable = \Cake\ORM\TableRegistry::get('Career');
        $career = $CareerTable->find()->where(['user_id' => $this->user->id, 'id' => $id])->first();
        if ($career) {
            if ($CareerTable->delete($career)) {
                return $this->Util->ajaxReturn(true, '删除成功');
            } else {
                return $this->Util->ajaxReturn(false, '删除失败');
            }
        } else {
            return $this->Util->ajaxReturn(false, '记录不存在');
        }
    }

    /**
     * 编辑名片
     */
    public function editCard() {
        $user_id = $this->user->id;
        $userInfo = $this->User->get($user_id);
        if ($this->request->is('post')) {
            $userInfo->card_path = $this->request->data('card_path');
            if ($this->User->save($userInfo)) {
                return $this->Util->ajaxReturn(true, '更改成功');
            } else {
                return $this->Util->ajaxReturn(false, '服务器开小差了');
            }
        }
        $this->set([
            'pageTitle' => '名片修改',
            'user' => $userInfo
        ]);
    }

    /**
     * 编辑标签
     */
    public function editMark() {
        $user_id = $this->user->id;
        $userInfo = $this->User->get($user_id);
        if ($this->request->is('post')) {
            if(is_array($this->request->data('tags')))
            {
                $userInfo->grbq = serialize($this->request->data('tags'));
            }else{
                $userInfo->grbq = '';
            }
            if ($this->User->save($userInfo)) {
                return $this->Util->ajaxReturn(true, '更新成功');
            } else {
                return $this->Util->ajaxReturn(false, '服务器开小差了');
            }
        }
        $ProfiletagTable = \Cake\ORM\TableRegistry::get('Profiletag');
        $profiletags = $ProfiletagTable->find('list')->select(['name'])->toArray();
        $mark_ser = $userInfo->grbq;  //个人标签
        $mark_arr = [];
        $extra_arr = [];
        if (is_array(unserialize($mark_ser))) {
            $mark_arr = unserialize($mark_ser);
            if ($mark_arr) {
                foreach ($mark_arr as $mark) {
                    if (!in_array($mark, $profiletags)) {
                        $extra_arr[] = $mark;
                    }
                }
            }
        }
        $this->set([
            'pageTitle' => '个人标签',
            'user' => $userInfo,
            'mark_arr' => $mark_arr,
            'profiletags' => $profiletags,
            'extra_mark' => $extra_arr
        ]);
    }

    /**
     * 名片夹
     */
    public function cardcase() {
        $this->handCheckLogin();
        $card = $this
                ->User
                ->CardBoxes
                ->find()
                ->contain(['OtherCard'=>function($q){
                    return $q->where(['OtherCard.enabled'=>1]);
                }])
                ->where(['ownerid' => $this->user->id, 'resend' => '2'])
                ->orderDesc('CardBoxes.`create_time`')
//                ->limit($this->limit)
                ->formatResults(function($items) {
                    return $items->map(function($item) {
                        $item->other_card->avatar = getSmallAvatar($item->other_card->avatar);
                        return $item;
                    });
                })
                ->toArray();
        $this->set('cardjson', json_encode($card));
        $this->set('pageTitle', '名片夹');
    }

    /**
     * 名片夹列表
     * @param int $resend
     */
    public function getCrad($resend) {
        $card = $this
                ->User
                ->CardBoxes
                ->find()
                ->contain(['OtherCard'])
                ->where(['ownerid' => $this->user->id, 'resend' => $resend, 'enabled'=>1])
                ->orderDesc('CardBoxes.`create_time`')
//                ->limit($this->limit)
                ->formatResults(function($items) {
                    return $items->map(function($item) {
                        $item->other_card->avatar = getSmallAvatar($item->other_card->avatar);
                        return $item;
                    });
                })
                ->toArray();
        if ($card) {
            return $this->Util->ajaxReturn(['status' => true, 'data' => $card]);
        } else if($card == []){
            return $this->Util->ajaxReturn(false, '名片夹为空');
        } else {
            return $this->Util->ajaxReturn(false, '系统错误');
        }
    }

    /**
     * 回赠动作
     * @param int $id
     */
    public function sendBack($id) {
        $sendMe = $this
                ->User
                ->CardBoxes
                ->find()
                ->where(['ownerid' => $this->user->id, 'uid' => $id])
                ->first();
//                                                                        $sendMe = $this->User->CardBoxes->get($sendMe->id);
        $sendMe->resend = 1;
        $res = $this->User->CardBoxes->save($sendMe);
        if ($res) {
            $cardbox = $this->User->CardBoxes->newEntity();
            $cardbox = $this->User->CardBoxes->patchEntity($cardbox, ['ownerid'=>$id, 'uid'=>$this->user->id, 'resend'=>1]);
            $this->User->CardBoxes->save($cardbox);
            return $this->Util->ajaxReturn(true, '回赠成功');
        } else {
            return $this->Util->ajaxReturn(false, '回赠失败');
        }
    }

    /**
     * 编辑行业标签
     */
    public function editIndustries() {
        $UserIndustryTable = \Cake\ORM\TableRegistry::get('UserIndustry');
        $userindustry = $UserIndustryTable->find()->where(['user_id' => $this->user->id])->hydrate(false)->toArray();
        $industry_id = [];
        foreach ($userindustry as $k => $v) {
            $industry_id[] = $v['industry_id'];
        }

        $IndustryTable = \Cake\ORM\TableRegistry::get('industry');
        $industries = $IndustryTable->find('threaded', [
                    'keyField' => 'id',
                    'parentField' => 'pid'
                ])->hydrate(false)->toArray();
        $this->set(array(
            'userIndustry' => $industry_id,
            'industries' => $industries,
            'pageTitle' => '选择行业标签'
        ));
    }
    
    /**
     * 编辑机构标签
     */
    public function editAgencies() {
        $UserTable = \Cake\ORM\TableRegistry::get('user');
        $user = $UserTable->get($this->user->id);
        $AgencyTable = \Cake\ORM\TableRegistry::get('agency');
        $agencies = $AgencyTable->find('threaded', [
                    'keyField' => 'id',
                    'parentField' => 'pid'
                ])->hydrate(false)->toArray();
        $this->set(array(
            'user' => $user,
            'agencies' => $agencies,
            'pageTitle' => '选择机构标签'
        ));
    }
    
    /**
     * 编辑所在城市
     */
    public function editCity(){
        $RegionTable = \Cake\ORM\TableRegistry::get('region');
        $region = $RegionTable->find()->all()->toArray();
        $city = $this->User->find()->select(['city'])->where(['id'=>$this->user->id])->hydrate(false)->first();
        $city = $city['city'];
        $this->set([
            'pageTitle'=>'选择所在城市',
            'city'=>$city,
            'region'=>$region
        ]);
    }
    
    /**
     * 保存所在城市
     */
    public function saveCity(){
        $city = $this->request->data('city');
        $user = $this->User->get($this->user->id);
        $user->city = $city;
        $res = $this->User->save($user);
        if($res){
            return $this->Util->ajaxReturn(true, '保存成功');
        } else {
            return $this->Util->ajaxReturn(false, '保存失败');
        }
    }

    /**
     * 保存行业标签
     */
    public function saveIndustries() {
        if ($this->request->is('post')) {
            $data = $this->request->data();
            $user = $this->User->get($this->user->id);
            $user = $this->User->patchEntity($user, $data);
            if ($this->User->save($user)) {
                return $this->Util->ajaxReturn(true, '保存成功');
            } else {
                return $this->Util->ajaxReturn(false, '保存失败');
            }
        }
    }
    
    /**
     * 保存行业标签
     */
    public function saveAgency() {
        if ($this->request->is('post')) {
            $agency_id = $this->request->data('agency');
            $user = $this->User->get($this->user->id);
            $user->agency_id = $agency_id;
            if ($this->User->save($user)) {
                return $this->Util->ajaxReturn(true, '保存成功');
            } else {
                return $this->Util->ajaxReturn(false, '保存失败');
            }
        }
    }

    /**
     * 我的关注搜索
     */
    public function myFollowingSearch() {
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $keyword = $data['keyword'];
            $user_id = $this->user->id;
            if($data['type'] == 1){
                $FansTable = \Cake\ORM\TableRegistry::get('user_fans');
                $followings = $FansTable->find()->contain(['Followings' => function($q)use($keyword) {
                        return $q->select(['id', 'truename', 'company', 'position', 'avatar', 'fans'])
                                ->where(['truename like' => "%$keyword%", 'enabled' => 1])->contain(['Subjects'=>function($q){
                                    return $q->where(['Subjects.is_del'=>0])->orderDesc('Subjects.create_time');
                                }]);
                    }])->hydrate(false)
                        ->where(['user_id' => $user_id])
                        ->formatResults(function($items) {
                            return $items->map(function($item) {
                                $item['following']['avatar'] = getSmallAvatar($item['following']['avatar']);
                                return $item;
                            });
                        })
                        ->toArray();
                if ($followings !== false) {
                    if ($followings) {
                        return $this->Util->ajaxReturn(['status' => true, 'data' => $followings]);
                    } else {
                        return $this->Util->ajaxReturn(false, '您的关注里无这个人');
                    }
                } else {
                    return $this->Util->ajaxReturn(false, '系统错误');
                }
            } elseif($data['type'] == 2){
                $FansTable = \Cake\ORM\TableRegistry::get('user_fans');
                $fans = $FansTable->find()->contain(['Users' => function($q)use($keyword) {
                        return $q->select(['id', 'truename', 'company', 'position', 'avatar', 'fans'])
                                ->where(['enabled' => 1, 'truename like' => "%$keyword%"])->contain(['Subjects'=>function($q){
                                    return $q->where(['Subjects.is_del'=>0]);
                                }]);
                    }])->hydrate(false)
                        ->where(['following_id' => $user_id])
                        ->formatResults(function($items) {
                            return $items->map(function($item) {
                                $item['user']['avatar'] = getSmallAvatar($item['user']['avatar']);
                                return $item;
                            });
                        })
                        ->toArray();
                if ($fans !== false) {
                    if ($fans) {
                        return $this->Util->ajaxReturn(['status' => true, 'data' => $fans]);
                    } else {
                        return $this->Util->ajaxReturn(false, '您的粉丝里无这个人');
                    }
                } else {
                    return $this->Util->ajaxReturn(false, '系统错误');
                }
            }
        }
    }

    /**
     * 名片夹搜索
     */
    public function searchcard() {
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $keyword = $data['keyword'];
            $resend = $data['resend'];
            $card = $this
                    ->User
                    ->CardBoxes
                    ->find()
                    ->contain(['OtherCard' => function($q)use($keyword) {
                        return $q->where(['OtherCard.truename like' => "%$keyword%", 'OtherCard.enabled'=>1]);
                    }])
                    ->where(['ownerid' => $this->user->id, 'resend' => $resend])
                    ->orderDesc('CardBoxes.`create_time`')
//                    ->limit($this->limit)
                    ->formatResults(function($items) {
                        return $items->map(function($item) {
                            $item->other_card->avatar = getSmallAvatar($item->other_card->avatar);
                            return $item;
                        });
                    })
                    ->toArray();
            if ($card !== false) {
                if ($card) {
                    return $this->Util->ajaxReturn(['status' => true, 'data' => $card]);
                } else {
                    return $this->Util->ajaxReturn(false, '您的名片夹里无这个人');
                }
            } else {
                return $this->Util->ajaxReturn(false, '系统错误');
            }
        }
    }
    
    /**
     * 找同行
     */
    public function searchPeople($id=null){
        $user_id = '';
        if($this->user){
            $user_id = $this->user->id;
        }
        $this->set([
            'pageTitle'=>'找同行',
            'sid' => $id,
            'user_id' => $user_id
        ]);
        
    }
    
    /**
     * ajax获取地区和标签
     */
    public function getRegionAndIndustries(){
        $regionTable = \Cake\ORM\TableRegistry::get('region');
        $industryTable = \Cake\ORM\TableRegistry::get('industry');
        $region = $regionTable->find()->hydrate(false)->all()->toArray();
        $industries = $industryTable->find()->hydrate(false)->all()->toArray();
        $industry = [];
        foreach($industries as $k=>$v){
            if($v['pid'] == 1){
                $industry[] = [
                    'id' => $v['id'],
                    'name' => $v['name'],
                ];
            }
        }
        return $this->Util->ajaxReturn([
            'status' => true,
            'region' => $region,
            'industries' => $industry,
        ]);
    }
    
    /**
     * 找同行结果
     */
    public function getSearchRes(){
        $where = [];
        $where['level'] = 2;
        $where['enabled'] = 1;
        $userTable = \Cake\ORM\TableRegistry::get('user');
        $data = $this->request->data();
        $user = $userTable->find()->contain(['Subjects']);
        if($data['industry_id']){
            $industry_id = $data['industry_id'];
            $user = $user->matching('Industries', function($q)use($industry_id){
                return $q;
            });
            $where['industry_id'] = $industry_id;
        } else {
            
        }
        
        if($data['region']){
            $city = $data['region'];
            if($city === '其他'){
                $where['city NOT LIKE'] = '%北京%';
                $where['city NOT LIKE'] = '%上海%';
                $where['city NOT LIKE'] = '%广州%';
                $where['city NOT LIKE'] = '%深圳%';
                $where['city NOT LIKE'] = '%成都%';
                $where['city NOT LIKE'] = '%杭州%';
                $where['city NOT LIKE'] = '%香港%';
                $where['city NOT LIKE'] = '%武汉%';
            } else {
                $where['city LIKE'] = '%' . $city . '%';
            }
        }
        
        if($data['keyword']){
            $where['User.truename LIKE'] = '%' . $data['keyword'] . "%";
        }
        $user = $user->where($where)->limit($this->limit)->toArray();
        if($user !== false){
            if($user == null){
                return $this->Util->ajaxReturn(false, '暂无同行');
            } else {
                return $this->Util->ajaxReturn(['status'=>true, 'data'=>$user]);
            }
        } else {
            return $this->Util->ajaxReturn(false, '系统错误');
        }
    }
    
    public function getMoreSearch($page){
        $where = [];
        $userTable = \Cake\ORM\TableRegistry::get('user');
        $data = $this->request->data();
        $user = $userTable->find()->contain(['Subjects']);
        if($data['industry_id']){
            $industry_id = $data['industry_id'];
            $user = $user->matching('Industries', function($q)use($industry_id){
                return $q;
            });
            $where['industry_id'] = $industry_id;
        }
        
        if($data['region']){
            $city = $data['region'];
            if($city === '其他'){
                $where['and'] = [
                    'city NOT LIKE'=>'%北京%',
                    'city NOT LIKE'=>'%上海%',
                    'city NOT LIKE'=>'%广州%',
                    'city NOT LIKE'=>'%深圳%',
                    'city NOT LIKE'=>'%成都%',
                    'city NOT LIKE'=>'%杭州%',
                    'city NOT LIKE'=>'%香港%',
                    'city NOT LIKE'=>'%武汉%',
                ];
            } else {
                $where['city LIKE'] = '%' . $city . '%';
            }
        }
        
        if($data['keyword']){
            $where['User.truename LIKE'] = '%' . $data['keyword'] . "%";
        }
        $user = $user->where($where)->page($page, $this->limit)->toArray();
        if($user !== false){
            if($user == null){
                return $this->Util->ajaxReturn(false, '暂无结果');
            } else {
                return $this->Util->ajaxReturn(['status'=>true, 'data'=>$user]);
            }
        } else {
            return $this->Util->ajaxReturn(false, '系统错误');
        }
    }
    
    /**
     * 服务条款
     */
    public function service(){
        $this->set('pageTitle', '服务条款');
    }
    /**
     * 免责声明
     */
    public function disclaimer(){
        $this->set('pageTitle', '免责声明');
    }
    
    /**
     * ajax获取用户个人资料状态
     */
    public function userinfoStatus(){
        $this->handCheckLogin();
        $user = $this->User->get($this->user->id, [
            'contain' => ['Industries', 'Educations', 'Careers', 'Agencies'],
        ]);
        $data = [];
        if($user){
            $data['city'] = $user->city ? $user->city : '';
            $data['gsyw'] = $user->gsyw ? $user->gsyw : '';
            $data['goodat'] = $user->goodat ? $user->goodat : '';
            $data['agency'] = $user->agency ? $user->agency->name : '';
            $industry = [];
            if($user->industries){
                foreach($user->industries as $k=>$v){
                    $industry[] = $v->name;
                }
            }
            $data['industry'] = $industry ? implode('、', $industry) : '';
            $data['educations'] = $user->educations ? $user->educations['0']->school : '';
            $data['careers'] = $user->careers ? $user->careers['0']->company : '';
            $data['grbq'] = $user->grbq ? implode('、', unserialize($user->grbq)) : '';
            $data['card_path'] = $user->card_path ? $user->card_path : '';
            return $this->Util->ajaxReturn(['status'=>true, 'data'=>$data]);
        } else {
            return $this->Util->ajaxReturn(false, '系统错误');
        }
    }
    
    /**
     * 用户的资料完整状态
     */
    public function getUserinfoStatus(){
        $UserTable = \Cake\ORM\TableRegistry::get('user');
        $user = $UserTable->get($this->user->id, [
            'contain' => ['Industries']
        ]);
        $is_complete = $user->company && $user->gender && $user->position && $user->email && $user->agency_id
                && $user->industries && $user->city && $user->goodat && $user->gsyw && $user->card_path;
        if($is_complete){
            return $this->Util->ajaxReturn(true);
        } else {
            return $this->Util->ajaxReturn(false, '请先去完善个人资料');
        }
    }
    
    /**
     * 保存用户资料
     */
    public function saveUserinfo(){
        if($this->user){
            $name = $this->request->data('name');
            $val = $this->request->data('val');
            if(trim($val) == ''){
                return $this->Util->ajaxReturn(false, '请填入内容');
            }
            $data = [];
            $UserTable = \Cake\ORM\TableRegistry::get('user');
            $user = $UserTable->get($this->user->id);
            $data[$name] = trim($val);
            $user = $UserTable->patchEntity($user, $data);
            $res = $UserTable->save($user);
            if($res){
                return $this->Util->ajaxReturn(true, '修改成功');
            } else {
                return $this->Util->ajaxReturn(false, '修改失败');
            }
        }
    }

    
    /**
     * 评论消息详情
     */
    public function commentView($id=null){
        $this->handCheckLogin();
        $user_id = $this->user->id;
        $type = $this->request->query('type');
        $commentTable = $type=='1'?'Newscom':'Activitycom';
        $table = $type=='1'?'News':'Activity';
        $relate_id = $type=='1'?'news_id':'activity_id';
        $reply_id = $type=='1'?'reply_user':'reply_id';
        $liketype = $type=='1'?'1':'0';
        $CommentTable = \Cake\ORM\TableRegistry::get($commentTable);
        $comment = $CommentTable->find()->contain(['Users'])->select()->where([$commentTable.'.id'=>$id])->first();
        $replys = $CommentTable->find()->contain(['Users', 'Likes'=>function($q)use($user_id){
            return $q->where(['type'=>1,'user_id'=>$user_id]);
        }])
                ->where(["$relate_id"=>$comment->$relate_id,"$reply_id"=>$comment->user_id,'is_delete'=>0])
                ->orderDesc($commentTable.'.create_time')
                ->toArray();
        $Table = \Cake\ORM\TableRegistry::get($table);
        $table_data = $Table->find()->contain(['Users'])->where([$table.'.id'=>$comment->$relate_id])->first();
        $LikeTable = \Cake\ORM\TableRegistry::get('CommentLike');
        $likes = $LikeTable->find()->contain(['Users'])->where(['relate_id'=>$id,'type'=>$liketype])
                ->orderDesc('CommentLike.create_time')
                ->toArray();
        $this->set([
            'table'=>$table_data,
            'comment'=>$comment,
            'replys'=>$replys,
            'likes'=>$likes,
            'id'=>$id,
            'type'=>$type,
            'tableName'=>$table,
            'relate_id'=>$comment->$relate_id,
            'user_id'=>$user_id
        ]);
    }
    
    public function allLike($id=null){
        $type = $this->request->query('type');
        $liketype = $type=='1'?'1':'0';
        $LikeTable = \Cake\ORM\TableRegistry::get('CommentLike');
        $likes = $LikeTable->find()->contain(['Users'])->where(['relate_id'=>$id,'type'=>$liketype])
                ->orderDesc('CommentLike.create_time')
                ->toArray();
        $this->set([
            'likes'=>$likes,
        ]);
    }

    
    /**
     * 消息已读
     */
    public function readMsg($id){
        $UsermsgTable = \Cake\ORM\TableRegistry::get('usermsg');
        $msg = $UsermsgTable->get($id);
        $msg->status = 1;
        $res = $UsermsgTable->save($msg);
        if($res){
            return $this->Util->ajaxReturn(true, '操作成功');
        } else {
            return $this->Util->ajaxReturn(false , '操作失败');
        }
    }

    public function follow($id=null){
        $FansTable = \Cake\ORM\TableRegistry::get('UserFans');
        $follows = $FansTable->find()->contain(['Followings'=>function($q){
            return $q->where(['enabled'=>1, 'is_del'=>0]);
        }])->where(['user_id'=>$id])->toArray();
        $this->set([
            'userjson' => json_encode($follows)
        ]);
    }
    
    public function fans($id=null){
        $FansTable = \Cake\ORM\TableRegistry::get('UserFans');
        $fans = $FansTable->find()->contain(['Users'=>function($q){
            return $q->where(['enabled'=>1, 'is_del'=>0]);
        }])->where(['following_id'=>$id])->toArray();
        $this->set([
            'userjson' => json_encode($fans)
        ]);
    }

}
                                                                                        