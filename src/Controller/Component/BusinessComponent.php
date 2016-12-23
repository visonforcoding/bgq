<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * 处理通用业务
 * Business component
 * @property \App\Controller\Component\SmsComponent $Sms
 * @property \App\Controller\Component\PushComponent $Push
 */
class BusinessComponent extends Component {

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    public $components = ['Sms', 'Push'];

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
     * 文章点赞
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
                        if (!$data['type']) { // 不同类型插入不同数据库（活动或者资讯）
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

    /**
     * 收藏文章
     * @param int $id
     * @return string|int 错误码或者成功
     */
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
     * @param type $push_id  发送id
     * @param type $user_id  接收id
     * @param type $title  标题
     * @param type $msg   内容
     * @param type $type  类型
     * @param type $id  对象id
     */
    public function usermsg($push_id, $user_id, $title, $msg, $type = 0, $id = 0,$redirect_url = null) {
        $UsermsgTable = \Cake\ORM\TableRegistry::get('usermsg');
        $PushlogTable = \Cake\ORM\TableRegistry::get('pushlog');
        $data = [
            'user_id' => $user_id,
            'type' => $type,
            'url' => '',
        ];
        if ($type != 0) {
            $types = \Cake\Core\Configure::read('usermsgType');
            $url = $types[$type]['url'];
            $data['url'] = $url;
        }
        if($redirect_url){
            $data['url']  = $redirect_url;
        }
        if ($type == 1) {
            //关注消息
            $usermsg = $UsermsgTable->newEntity();
            $usermsg->user_id = $user_id;
            $usermsg->type = $type;
            $usermsg->url = $url;
            $usermsg->title = '您有新的关注者';
            $usermsg->msg = '您有1位新的关注者';
        }
        if($type==2){
            //资讯评论点赞消息
        }
        $usermsg = $UsermsgTable->newEntity(array_merge($data, [
            'title' => $title,
            'msg' => $msg,
            'table_id' => $id,
        ]));
        $res = $UsermsgTable->save($usermsg);
        if (!$res) {
            \Cake\Log\Log::error($usermsg,'devlog');
            \Cake\Log\Log::error($usermsg->errors(),'devlog');
        } else {
            $userTable = \Cake\ORM\TableRegistry::get('user');
            $push = $userTable->get($push_id);
            $user = $userTable->get($user_id);
            if($type == 1){
                $data = [
                   'url' => 'http://m.chinamatop.com/home/my-message-fans/1'
                ];
                $this->Push->sendAlias($user->user_token, $push->truename . '关注了您', ' ', $push->truename . '关注了您', 'BGB', true, $data);
                $pushlog = $PushlogTable->newEntity();
                $pushlog->push_id = $push_id;
                $pushlog->receive_id = $user_id;
                $pushlog->title = $push->truename . '关注了您';
                $pushlog->body = ' ';
                $pushlog->type = 2;
                $PushlogTable->save($pushlog);
            } else {
                $data = [
                   'url' => 'http://m.chinamatop.com/home/my-message-fans/2' 
                ];
                $this->Push->sendAlias($user->user_token, $title, $msg, $title, 'BGB', true, $data);
                $pushlog = $PushlogTable->newEntity();
                $pushlog->push_id = $push_id;
                $pushlog->receive_id = $user_id;
                $pushlog->title = $title;
                $pushlog->body = $msg;
                $pushlog->type = 2;
                $PushlogTable->save($pushlog);
            }
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
                $table = 'Activitycom';
                break;
            case 1:
                $table = 'Newscom';
            default:
                break;
        }
        $RelateTable = \Cake\ORM\TableRegistry::get($table);
        $relate = $RelateTable->get($relate_id, ['contain' => ['Users']]);
        if (!$relate) {
            return '该条评论不存在';
        }
        $data = [
            'user_id' => $user_id,
            'relate_id' => $relate_id,
            'type' => $type
        ];
        $ComLikeTable = \Cake\ORM\TableRegistry::get('CommentLike');
        $comlike = $ComLikeTable->find()->where($data)->first();
        if ($comlike) {
            //点过赞
            return '你已点过赞';
        }else{
            $comlike = $ComLikeTable->newEntity($data);
        }
         $transRes = $ComLikeTable->connection()->transactional(function()use($ComLikeTable, $comlike, $relate, $RelateTable) {
            //\Cake\Log\Log::debug($comlike,'devlog');
            $relate->praise_nums +=1;
            return $ComLikeTable->save($comlike)&&$RelateTable->save($relate);
        });
        if($transRes){
            //发送消息给该条评论的用户
            $com_userid = $relate->user->id;
            if($type==0){
                $table_id = $relate->activity_id; 
                $redirect_url = '/home/comment-view/'.$relate_id.'?type=2';
                $this->usermsg($user_id, $com_userid, '您有新的点赞', '您的评论获得新的点赞', 8, $relate_id,$redirect_url);
            }else{
                $table_id = $relate->news_id; 
                $redirect_url = '/home/comment-view/'.$relate_id.'?type=1';
                $this->usermsg($user_id, $com_userid, '您有新的点赞', '您的评论获得新的点赞', 2, $relate_id,$redirect_url);
            }
            return true;
        }else{
            \Cake\Log\Log::error($comlike->errors(),'devlog');
        }
        return false;
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
            return '点赞内容不存在';
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
//            return '你已点过赞';
            $like = $likeTable->get($comlike->id);
            $res = $likeTable->connection()->transactional(function()use($likeTable, $like, $relate, $RelateTable) {
                $relate->praise_nums -=1;
                return $likeTable->delete($like)&&$RelateTable->save($relate);
            });
            if($res){
                return '取消点赞成功';
            } else {
                return '取消点赞失败';
            }
        }
        $data['msg'] = '进行了点赞';
        $comlike = $likeTable->newEntity($data);
        $transRes = $likeTable->connection()->transactional(function()use($likeTable, $comlike, $relate, $RelateTable) {
            $relate->praise_nums +=1;
            return $likeTable->save($comlike)&&$RelateTable->save($relate);
        });
        if (!$transRes) {
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
                break;
            case 2:
                $table = 'user';
                break;
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
                'msg' => '取消收藏成功'
            ];
        }
        if ($collectTable->save($collect)) {
            return $res;
        } else {
            return false;
        }
    }

    /**
     * 处理订单业务
     * @param \App\Model\Entity\Order $order
     * @param float $realFee 实际支付金额
     * @param int $payType 支付方式
     * @param string $out_trade_no 第三方平台交易号
     */
    public function handOrder(\App\Model\Entity\Order $order,$realFee,$payType,$out_trade_no) {
        if ($order->type == 1) {
            //处理预约
            return $this->handMeetOrder($order,$realFee,$payType,$out_trade_no);
        } elseif ($order->type == 2) {
            // 处理报名
            return $this->handApplyOrder($order,$realFee,$payType,$out_trade_no);
        } elseif($order->type == 3) {
            // 处理充值
            \Cake\Log\Log::debug('准备充值', 'devlog');
            return $this->handChargeOrder($order,$realFee,$payType,$out_trade_no);
        }
    }

    /**
     * 处理预约订单 1.预约状态更改 2.订单状态更改 3.专家 余额更改 4.交易流水记录生成
     * @param \App\Model\Entity\Order $order
     */
    protected function handMeetOrder(\App\Model\Entity\Order $order,$realFee,$payType,$out_trade_no) {
        $book_id = $order->relate_id;
        $BookTable = \Cake\ORM\TableRegistry::get('SubjectBook');
        $book = $BookTable->get($book_id);
        $book->status = 3; //预约流程完成
        $order->status = 1;  //订单完成
        $order->fee = $realFee;  //实际支付金额
        $order->paytype = $payType;  //实际支付金额
        $order->out_trade_no = $out_trade_no;  //第三方订单号
        $pre_amount = $order->seller->money;
        $order->seller->money += $order->price;    //专家余额+
        $order->seller->meet_nums += 1;    // 约见次数+1
        $order->dirty('seller', true);  //这里的seller 一定得是关联属性 不是关联模型名称 可以理解为实体
        $OrderTable = \Cake\ORM\TableRegistry::get('Order');
        $FlowTable = \Cake\ORM\TableRegistry::get('Flow');
        $flow = $FlowTable->newEntity([
            'user_id' => $order->seller_id,
            'type' => 1,
            'relate_id'=>$order->id,   //关联的订单id
            'type_msg' => '约见收入',
            'income' => 1,
            'amount' => $order->price,
            'pre_amount' => $pre_amount,
            'after_amount' => $order->seller->money,
            'status' => 1,
            'remark' => '约见获取收入-' . $order->user->truename
        ]);
        $transRes = $BookTable->connection()->transactional(function()use($order, $BookTable, $book, $OrderTable, $FlowTable, $flow) {
            return $OrderTable->save($order, ['associated' => ['Sellers']]) && $BookTable->save($book) && $FlowTable->save($flow);
        });
        if ($transRes) {
            //向专家和买家发送一条短信
            //资金流水记录
            $seller_msg =  '申请人'.$order->user->truename.'手机号:'.$order->user->phone.'已经向您支付了预约费用：' . $order->price . '元，请做好赴约准备。';
            $this->Sms->sendByQf106($order->seller->phone,$seller_msg);
            $buyer_msg = '您已支付成功,可凭短信赴约,专家:'.$order->seller->truename.'手机号:'.$order->seller->phone;
            $this->Sms->sendByQf106($order->user->phone, $buyer_msg);
            return true;
        }else{
            return false;
        }
    }
    /**
     * 处理活动报名  1.报名状态更改 2.报名人数+1 3.并购帮用户余额+ 4.交易流水
     * @param \App\Model\Entity\Order $order
     */
    protected function handApplyOrder(\App\Model\Entity\Order $order,$realFee,$payType,$out_trade_no) {
        $activityapply_id = $order->relate_id;
        $ActivityapplyTable = \Cake\ORM\TableRegistry::get('Activityapply');
        $Activityapply = $ActivityapplyTable->get($activityapply_id, [
            'contain' => ['Activities'],
        ]);
        $Activityapply->is_pass = 1; //报名通过
        $Activityapply->is_check = 1; //审核通过
        $order->status = 1;  //订单完成
        $order->fee = $realFee;  //实际支付金额
        $order->paytype = $payType;  //实际支付方式
        $order->out_trade_no = $out_trade_no;  //第三方订单号
        $pre_amount = $order->seller->money;
        $order->seller->money += $order->price;    //余额+
        $Activityapply->activity->apply_nums += 1;    // 报名次数+1
        $Activityapply->dirty('activity',true);   // 报名次数+1
        $order->dirty('seller', true);  //这里的seller 一定得是关联属性 不是关联模型名称 可以理解为实体
        $OrderTable = \Cake\ORM\TableRegistry::get('Order');
        $FlowTable = \Cake\ORM\TableRegistry::get('Flow');
        $flow = $FlowTable->newEntity([
            'user_id' => -1,
            'buyer_id'=>$order->user->id,
            'type' => 2,
            'relate_id'=>$order->id,   //关联的订单id
            'type_msg' => '报名收入',
            'income' => 1,
            'amount' => $order->fee,
            'price'=>$order->price,
            'pre_amount' => $pre_amount,
            'paytype'=>$order->paytype,
            'after_amount' => $order->seller->money,
            'status' => 1,
            'remark' => '报名活动《'.$Activityapply->activity->title.'》获取收入'
        ]);
        $transRes = $ActivityapplyTable->connection()->transactional(function()use($order, $ActivityapplyTable,
                $Activityapply, $OrderTable, $FlowTable, $flow) {
            return $OrderTable->save($order, ['associated' => ['Sellers']]) && 
                    $ActivityapplyTable->save($Activityapply,['associated' => ['Activities']]) && $FlowTable->save($flow);
        });
        if ($transRes) {
            //向专家和买家发送一条短信
            //资金流水记录
            $buyer_msg = '您已成功报名活动《' . $Activityapply->activity->title . '》，详情请打开并购帮APP查看';
            $this->Sms->sendByQf106($order->user->phone, $buyer_msg);
            return true;
        }else{
            return false;
        }
    }
    /**
     * 处理充值  1.根据订单 2.处理赠额 3.并购帮用户余额+ 4.交易流水
     * @param \App\Model\Entity\Order $order
     */
    protected function handChargeOrder(\App\Model\Entity\Order $order,$realFee,$payType,$out_trade_no) {
//        \Cake\Log\Log::debug('开始处理', 'devlog');
        $order->status = 1;  //订单完成
        $order->fee = $realFee;  //实际支付金额
        $order->paytype = $payType;  //实际支付方式
        $order->out_trade_no = $out_trade_no;  //第三方订单号
        $pre_amount = $order->seller->money;
        $order->seller->money = $order->seller->money + $order->price + $order->gift;    //余额+
        $order->dirty('seller', true);  //这里的seller 一定得是关联属性 不是关联模型名称 可以理解为实体
        $OrderTable = \Cake\ORM\TableRegistry::get('Order');
        $FlowTable = \Cake\ORM\TableRegistry::get('Flow');
        $flow = $FlowTable->newEntity([
            'user_id' => $order->user->id,
            'buyer_id'=>$order->user->id,
            'type' => 3,
            'relate_id'=>$order->id,   //关联的订单id
            'type_msg' => '充值钱包',
            'income' => 1,
            'amount' => $order->fee,
            'price'=>$order->price,
            'pre_amount' => $pre_amount,
            'paytype'=>$order->paytype,
            'after_amount' => $pre_amount + $order->price,
            'status' => 1,
            'remark' => '充值收入'
        ]);
        $gift = [];
        if($order->gift){
            $gift = $FlowTable->newEntity([
                'user_id' => $order->user->id,
                'buyer_id'=>$order->user->id,
                'type' => 4,
                'relate_id'=>$order->id,   //关联的订单id
                'type_msg' => '充值赠送',
                'income' => 1,
                'amount' => 0,
                'price'=>$order->gift,
                'pre_amount' => $pre_amount + $order->price,
                'paytype'=>4,
                'after_amount' => $pre_amount + $order->price + $order->gift,
                'status' => 1,
                'remark' => '赠送收入',
                'is_gift' => 1
            ]);
        }
        $transRes = $OrderTable->connection()->transactional(function()use($order, $OrderTable, $FlowTable, $flow, $gift) {
            $res = $OrderTable->save($order, ['associated' => ['Sellers']]) && $FlowTable->save($flow);
            if($order->gift){
                return $res && $FlowTable->save($gift);
            } else {
                return $res;
            }
        });
//        \Cake\Log\Log::debug('处理结束', 'devlog');
//        \Cake\Log\Log::debug($transRes, 'devlog');
        if ($transRes) {
            //向专家和买家发送一条短信
            //资金流水记录
//            $buyer_msg = '您已成功报名活动《' . $Activityapply->activity->title . '》，详情请打开并购帮APP查看';
//            $this->Sms->sendByQf106($order->user->phone, $buyer_msg);
            return true;
        }else{
            return false;
        }
    }
    
    public function checkDate($start, $end){
        if($start === '' && $end === ''){
            return false;
        } elseif($start === '至今') {
            return false;
        } elseif($end !== '至今' && $end < $start) {
            return false;
        }
        return true;
    }

}