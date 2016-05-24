<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * 处理通用业务
 * Business component
 */
class BusinessComponent extends Component {

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     * 评论点赞
     * @param int $id 评论id，赞的是哪条评论
     * @param string $table 表名,小写
     */
    public function comLike($id, $table) {
        // 检查是否post
        if ($this->request->is('post')) {
            // 检查是否登录
            if ($this->request->session()->read('User.mobile')) {
                $data = $this->request->data(); // 这里传过来的数据为['type'=>'','relate_id'=>'']
                $data['user_id'] = $this->request->session()->read('User.mobile')->id;
                $Table = \Cake\ORM\TableRegistry::get($table);
                $like = $Table->newEntity();
                $like = $Table->patchEntity($like, $data);
                if ($Table->find()->where($data)->first()) {// 查找是否已经赞过了
                    return 1;
                } else {
                    if ($Table->save($like)) { // 插入数据库
                        if (!$data['type']) { // 不同类型插入不用数据库（活动或者资讯）
                            $activitycom = \Cake\ORM\TableRegistry::get('Activitycom');
                            $comment = $activitycom->get($id, [
                                'contain' => [],
                            ]);
                            $comment->praise_nums += 1;
                            $activitycom->save($comment);
                        } else {
                            $Newscom = \Cake\ORM\TableRegistry::get('Newscom');
                            $comment = $Newscom->get($id, [
                                'contain' => [],
                            ]);
                            $comment->praise_nums += 1;
                            $Newscom->save($comment);
                        }
                        return 'success';
                    } else {
                        return 2;
                    }
                }
            } else {
                return 3;
            }
        } else {
            return 4;
        }
    }

    /**
     * 文章点赞表
     * @param int $id 评论id，赞的是哪篇文章
     * @param string $table 表名,小写
     */
    public function artLike($id, $table) {
        // 检查是否post
        if ($this->request->is('post')) {
            // 检查是否登录
            if ($this->request->session()->read('User.mobile')) {
                $data = $this->request->data(); // 这里传过来的数据为['type'=>'','relate_id'=>'']
                $data['user_id'] = $this->request->session()->read('User.mobile')->id;
                $Table = \Cake\ORM\TableRegistry::get($table);
                $like = $Table->newEntity();
                $like = $Table->patchEntity($like, $data);
                if ($Table->find()->where($data)->first()) {// 查找是否已经赞过了
                    return 1;
                } else {
                    if ($Table->save($like)) { // 插入数据库
                        if (!$data['type']) { // 不同类型插入不用数据库（活动或者资讯）
                            $activity = \Cake\ORM\TableRegistry::get('Activity');
                            $comment = $activity->get($id, [
                                'contain' => [],
                            ]);
                            $comment->praise_nums += 1;
                            $activity->save($comment);
                        } else {
                            $News = \Cake\ORM\TableRegistry::get('News');
                            $comment = $News->get($id, [
                                'contain' => [],
                            ]);
                            $comment->praise_nums += 1;
                            $News->save($comment);
                        }
                        return 'success';
                    } else {
                        return 2;
                    }
                }
            } else {
                return 3;
            }
        } else {
            return 4;
        }
    }

    public function collect($id) {
        // 检查是否post
        if ($this->request->is('post')) {
            // 检查是否登录
            if ($this->request->session()->read('User.mobile')) {
                $data = $this->request->data(); // 这里传过来的数据为['type'=>'','relate_id'=>'']
                $data['user_id'] = $this->request->session()->read('User.mobile')->id;
                $Table = \Cake\ORM\TableRegistry::get('collect');
                $collect = $Table->newEntity();
                $collect = $Table->patchEntity($collect, $data);
                if ($Table->find()->where($data)->first()) {// 查找是否已经收藏过了
                    return 5;
                } else {
                    if ($Table->save($collect)) { // 插入数据库
                        return 'success';
                    } else {
                        return 2;
                    }
                }
            } else {
                return 3;
            }
        } else {
            return 4;
        }
    }

    /**
     * 后台管理员消息 待处理事务
     * @param type $type
     * @param type $id 记录ID
     * @param type $msg
     */
    public function adminmsg($type, $id, $msg) {
        $AdminmsgTable = \Cake\ORM\TableRegistry::get('adminmsg');
        $adminmsg = $AdminmsgTable->newEntity(['type' => $type, 'table_id' => $id, 'msg' => $msg]);
        $AdminmsgTable->save($adminmsg);
    }

    /**
     * 用户消息
     * @param type $user_id  用户id
     * @param type $title  标题
     * @param type $msg   内容
     * @param type $type  类型
     * @param type $id  对象id
     */
    public function usermsg($user_id, $title, $msg, $type = 0, $id = 0) {
        if ($type != 0) {
            $types = \Cake\Core\Configure::read('usermsgType');
            $url = $types[$type]['url'];
        }
        $UsermsgTable = \Cake\ORM\TableRegistry::get('usermsg');
        $data = [
            'user_id' => $user_id,
            'type' => $type,
            'url' => $url,
        ];
        if ($type == 1) {
            //关注消息
            $usermsg = $UsermsgTable->newEntity();
            $usermsg->user_id = $user_id;
            $usermsg->type = $type;
            $usermsg->url = $url;
            $usermsg->table_id = $id; //被关注者id
            $usermsg->title = '您有新的关注者';
            $usermsg->msg = '您有1位新的关注者';
        }
        $usermsg = $UsermsgTable->newEntity(array_merge($data, [
            'title' => $title,
            'msg' => $msg,
            'table_id' => $id,
        ]));
        if (!$UsermsgTable->save($usermsg)) {
            \Cake\Log\Log::error($usermsg->errors());
        }
    }

    /**
     * 
     * 对评论的点赞
     * @param type $user_id
     * @param type $relate_id
     * @param type $type  评论的类型 0 活动 1资讯
     */
    public function commentPraise($user_id, $relate_id, $type) {
        //检测是否评论过
        switch ($type) {
            case 0:
                $table = 'activitycom';
                break;
            case 1:
                $table = 'newscom';
            default:
                break;
        }
        $RelateTable = \Cake\ORM\TableRegistry::get($table);
        $relate = $RelateTable->get($relate_id, ['contain' => ['Users']]);
        if (!$relate) {
            throw new \Cake\Network\Exception\NotFoundException('该条评论不存在');
        }
        $data = [
            'user_id' => $user_id,
            'relate_id' => $relate_id,
            'type' => $type
        ];
        $ComLikeTable = \Cake\ORM\TableRegistry::get('comment_like');
        $comlike = $ComLikeTable->find()->where($data)->first();
        if ($comlike) {
            //点过赞
            return false;
        }
        $comlike = $ComLikeTable->newEntity($data);
        if (!$ComLikeTable->save($comlike)) {
            //增加 点赞记录
            return false;
        }
        $relate->praise_nums +=1;
        if (!$RelateTable->save($relate)) {
            //评论点赞数+1
            return false;
        }
        //发送消息给该条评论的用户
        $com_userid = $relate->user->id;
        $this->usermsg($com_userid, '您有新的点赞', '您的评论获得新的点赞', 2, $relate_id);
        return true;
    }

    /**
     * 
     * @param type $user_id
     * @param type $relate_id
     * @param type $type 0活动  1资讯
     * @return boolean
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function praise($user_id, $relate_id, $type) {
        //检测是否评论过
        switch ($type) {
            case 0:
                $table = 'activity';
                break;
            case 1:
                $table = 'news';
            default:
                break;
        }
        $RelateTable = \Cake\ORM\TableRegistry::get($table);
        $relate = $RelateTable->get($relate_id);
        if (!$relate) {
            throw new \Cake\Network\Exception\NotFoundException('点赞内容不存在');
        }
        $data = [
            'user_id' => $user_id,
            'relate_id' => $relate_id,
            'type' => $type
        ];
        $likeTable = \Cake\ORM\TableRegistry::get('like_logs');
        $comlike = $likeTable->find()->where($data)->first();
        if ($comlike) {
            //点过赞
            return '你已点过赞';
        }
        $data['msg'] = '进行了点赞';
        $comlike = $likeTable->newEntity($data);
        $errorFlag = [];
        $likeTable->connection()->transactional(function()use($likeTable, $comlike, $relate, $RelateTable, $errorFlag) {
            $errorFlag[] = $likeTable->save($comlike);
            $relate->praise_nums +=1;
            $errorFlag[] = $RelateTable->save($relate);
        });
        if (in_array(false, $errorFlag)) {
            return '点赞失败';
        }
        return true;
    }

   /**
    * 
    * @param type $user_id
    * @param type $relate_id 
    * @param type $type 0 活动 1资讯
    * @return boolean|array false 执行失败  array 成功执行的返回
    * @throws \Cake\Network\Exception\NotFoundException
    */
    public function collectIt($user_id, $relate_id, $type) {
        //检测是否评论过
        switch ($type) {
            case 0:
                $table = 'activity';
                break;
            case 1:
                $table = 'news';
            default:
                break;
        }
        $RelateTable = \Cake\ORM\TableRegistry::get($table);
        $relate = $RelateTable->get($relate_id);
        if (!$relate) {
            throw new \Cake\Network\Exception\NotFoundException('点赞内容不存在');
        }
        $data = [
            'user_id' => $user_id,
            'relate_id' => $relate_id,
            'type' => $type
        ];
        $collectTable = \Cake\ORM\TableRegistry::get('collect');
        $collect = $collectTable->findOrCreate($data, function($entity) {
            $entity->is_delete = 1;  //初始数据 取消
        });
        if ($collect->is_delete) {
            //收藏
            $collect->is_delete = 0;
            $res = [
                'collect' => true,
                'msg' => '收藏成功'
            ];
        } else {
            //取消收藏
            $collect->is_delete = 1;
            $res = [
                'collect' => false,
                'msg' => '取消收藏'
            ];
        }
        if ($collectTable->save($collect)) {
            return $res;
        } else {
            return false;
        }
    }

}
