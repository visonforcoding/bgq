<?php

/**
 * Encoding     :   UTF-8
 * Created on   :   2016-4-13 14:32:54 by caowenpeng , caowenpeng1990@126.com
 * 数据配置文件
 */
return [
    'key' => [
        'hanvon' => 'b7be897a-a101-4163-88c9-d914cd9ecb59'
        //,'juhe' => '9379ea56576d3d2c07c992afa3383f3b'
    ],
    'sms' => [
        'userid' => 14394,
        'account' => 'chinamatop',
        'password' => 'jyh1606_jh'
    ],

    'weixin' => [
        'appID' => 'wx0cf353f9fc03aad0',
        'appsecret' => '460366e0beddcf18a21873db11a4eb1c',
        'token'=>'cwptest',
        'mchid'=>'1348060901',
        'App_mchid'=>'1350978901',
        'key'=>'33DB349F8DB955DC78FC5F84F8E5D3F8',
        'sslcert_path'=> dirname(__FILE__).'/wxcert/apiclient_cert.pem',
        'sslkey_path'=> dirname(__FILE__).'/wxcert/apiclient_key.pem',
        'notify_url'=>'/wx/wx-notify',
        'AppID'=>'wxb450720adce7295f',     //APP端的 开放平台appid
        'AppSecret'=>'1c721c93e80578c2b707358993dcd371'
    ],
    'umeng' => [
        'AppKey' => '57552eac67e58e5bdb001c6c',
        'AppMasterSecret' => 'vq6gyz0uztuke0yz5wcodsluhfm339vf',
        'UmengMessageSecret' => '795ffe74e61cd9b28cba5efd98f97171',
    ]
];
