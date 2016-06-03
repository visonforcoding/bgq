<?php

/**
 * Encoding     :   UTF-8
 * Created on   :   2016-4-13 14:32:54 by caowenpeng , caowenpeng1990@126.com
 * 数据配置文件
 */
return [
    'key' => [
        'hanvon' => '4b650ea1-b39b-4dc2-b797-68f3de0dec19',
        'juhe' => '9379ea56576d3d2c07c992afa3383f3b'
    ],
    'sms' => [
        'userid' => 11053,
        'account' => 'xifeo',
        'password' => 'SHAOye1688'
    ],
    'weixin' => [
        'appID' => 'wxf3d1e078715e41ce',
        'appsecret' => '293c2fb5bcf96db8eea854365471d48b',
        'token'=>'cwptest',
        'mchid'=>'1296107201',
        'key'=>'3596f7e1a0f6d4171005f9226f3e36ec',
        'sslcert_path'=> dirname(__FILE__).'/wxcert/apiclient_cert.pem',
        'sslkey_path'=> dirname(__FILE__).'/wxcert/apiclient_key.pem',
        'notify_url'=>'/wx/wx-notify'
    ]
];
