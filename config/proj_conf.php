<?php

/**
 * Encoding     :   UTF-8
 * Created on   :   2016-4-22 16:46:53 by caowenpeng , caowenpeng1990@126.com
 */
return [
    'bannerTypes' => [
        '1' => '资讯',
        '2' => '活动'
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
        ]
    ],
];
