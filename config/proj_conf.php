<?php

/**
 * Encoding     :   UTF-8
 * Created on   :   2016-4-22 16:46:53 by caowenpeng , caowenpeng1990@126.com
 */
return [
    'bannerTypes' => [
        '1' => '资讯',
        '2' => '活动',
        '3' => '大咖',
    ],
    'recommendTypes' => [
        '1' => '嘉宾推荐',
        '2' => '场地赞助',
        '3' => '现金赞助',
        '4' => '物品赞助',
        '5' => '其他',
    ],
    'adminmsgType'=>[
        '1'=>[
            'table'=>'user',
            'remark'=>'实名认证审核',
            'url'=>'/admin/user/index'
        ]
    ],
    'usermsgType'=>[
        '1'=>[
            'table'=>'user',
            'remark'=>'关注消息',
            'url'=>'/admin/user/index'
        ],
        '2'=>[
            'table'=>'newscom',
            'remark'=>'资讯评论点赞消息',
            'url'=>'/news/view/details'
        ],
      '3'=>[
            'table'=>'newscom',
            'remark'=>'资讯评论回复消息',
            'url'=>'/news/view/{#id#}#{#com_id#}'
        ],
      '4'=>[
            'table'=>'subject_book',
            'remark'=>'话题预约',
            'url'=>'/home/my-book/{#type#}'
        ],
      '5'=>[
            'table'=>'savant',
            'remark'=>'专家申请',
            'url'=>'/home/savant-auth'
      ],
      '6'=>[
          'table'=>'need',
          'remark'=>'小秘书消息',
          'url'=>'/home/my-xiaomi'
      ],
        '7'=>[
            'table'=>'activity',
            'remark'=>'活动报名',
            'url'=>'/home/my_activity_submit'
        ],
        '8'=>[
            'table'=>'activitycom',
            'remark'=>'活动评论点赞消息',
            'url'=>'/activity/details/{#id#}#{#com_id#}'
        ],
        '9'=>[
            'table'=>'activitycom',
            'remark'=>'活动评论回复消息',
            'url'=>'/activity/details/{#id#}#{#com_id#}'
        ],
        '10'=>[
            'table'=>'withdraw',
            'remark'=>'提现申请',
            'url'=>'/home/my-purse'
        ],
//        '11'=>[
//            'table'=>'activityapply',
//            'remark'=>'活动报名',
//            'url'=>'/activity/detail/{#id}'
//        ],
    ],
    'educationType'=>[
        '1'=>'高中',
        '2'=>'中专',
        '3'=>'大专',
        '4'=>'本科',
        '5'=>'研究生',
        '6'=>'硕士',
        '7'=>'博士'
    ],
    'secretType'=>[
        '1'=>'公开',
        '2'=>'不公开'
    ],
    'gener'=>[
        '1'=>'男',
        '2'=>'女'
    ],
    'userLevel'=>[
        '1'=>'普通',
        '2'=>'专家'
    ],
    'savantStatus'=>[
        '0'=>'审核不通过',
        '1'=>'未认证',
        '2'=>'待审核',
        '3'=>'审核通过',
    ],
    'userGrade'=>[
        '1'=>'普通',
        '2'=>'高级',
        '3'=>'vip',
    ],
    'activitySeries'=>[
        '沙龙论坛','生活聚会','学习培训','招聘服务'
    ],
    'flowType'=>[
        '1'=>'约见收入',
        '2'=>'报名收入',
        '3'=>'提现',
        '4'=>'提现退款',
    ],
    'votingType'=>[
        '1'=>'产业菁英',
        '2'=>'金融菁英',
        '3'=>'顾问菁英',
    ]
];
