<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Core\Configure;
use Cake\Network\Http\Client;
use Intervention\Image\ImageManagerStatic as Image;

/**
 * Hanvon component  汉王识别接口
 */
class HanvonComponent extends Component {

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     * 官方Api
     * @param type $imgFile
     * @return type
     */
    public function handMpByHanvon($imgFile) {

        $key = Configure::read('key.hanvon');
        if (!$key) {
            throw new \Exception('未配置汉王API key');
        }
//        $imgData = (string) Image::make($imgFile)->greyscale()->encode('png')->encode('data-url');  //灰阶处理
//        preg_match('/data:image\/png;base64,(.*)/',$imgData,$matches); //实际他们需要的字符串不需要前面的东西
//        $base64 = $matches[1];
        //$base64 = base64_encode(file_get_contents($imgFile)); //不灰阶处理
        $base64 = $this->resizeImg($imgFile);  //压缩并返回base64

        $http = new Client();
        $requestData = [
            'lang' => 'chns',
            'image' => $base64,
                // 'color'=>'gray'  //无论是不是经过了灰阶处理 返回都错了,不知什么原因
        ];
        $response = $http->post('http://api.hanvon.com/rt/ws/v1/ocr/bcard/recg?key='
                . $key . '&code=cf22e3bb-d41c-47e0-aa44-a92984f5829d', (string) json_encode($requestData), ['headers' => ['Content-Type' => 'application/octet-stream']]
        );
        if ($response->isOk()) {
            $body = json_decode($response->body());
            if ($body->code == '0') {
                return $body;
            } else {
                return false;
            }
        } else {
            return false;
        }
        return $response;
    }

    /**
     * 调聚合API
     * @param type $imgFile
     * @return boolean
     * @throws Exception
     */
    public function handMpByJuhe($imgFile) {
        $url = 'http://op.juhe.cn/hanvon/bcard/query'; //名片识别api地址
        $key = Configure::read('key.juhe');
        if (!$key) {
            throw new Exception('未配置聚合API key');
        }
        //$imgData = (string) Image::make($imgFile)->resize('300', '200')->encode('data-url');  //灰阶处理
        //preg_match('/data:.*;base64,(.*)/', $imgData, $matches); //实际他们需要的字符串不需要前面的东西
        //$base64 = $matches[1];
//        $base64 = base64_encode(file_get_contents($imgFile));
        $base64 = $this->resizeImg($imgFile);  //压缩并返回base64
        $params = array(
            'image' => $base64, //将名片内容转为base64编码
            'key' => $key, //这里填写你申请到的appkey
//            'color' => 'gray', 
        );
        $content = $this->juhecurl($url, $params, 1);
        $result = json_decode($content, true);
        if ($result) {
            $error_code = $result['error_code'];
            if ($error_code == '0') {
                return $result['result']; //可以根据聚合官方的在线文档说明解析自己需要的字段内容
            } else {
                return $result['reason'];
            }
        } else {
            return false;
        }
    }

    /**
     * 聚合curl
     * @param type $url api地址
     * @param type $params 
     * @param type $ispost
     * @return boolean
     */
    public function juhecurl($url, $params = false, $ispost = 0) {
        $httpInfo = array();
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($ispost) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_URL, $url);
        } else {
            if ($params) {
                curl_setopt($ch, CURLOPT_URL, $url . '?' . $params);
            } else {
                curl_setopt($ch, CURLOPT_URL, $url);
            }
        }
        $response = curl_exec($ch);
        if ($response === FALSE) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
        curl_close($ch);
        return $response;
    }

    
    /**
     * 更改图像大小
     * @param type $s_img 原图片路径
     * @param type $e_width
     * @param type $e_height
     * @return type base64
     */
    public function resizeImg($s_img, $e_width = '900', $e_height = '800') {
        // Get new sizes
        list($width, $height, $type) = getimagesize($s_img);
        switch ($type) {
            case "1": $imorig = imagecreatefromgif($s_img);
                break;
            case "2": $imorig = imagecreatefromjpeg($s_img);
                break;
            case "3": $imorig = imagecreatefrompng($s_img);
                break;
            default: $imorig = imagecreatefromjpeg($s_img);
        }
        // Load
        $thumb = imagecreatetruecolor($e_width, $e_height);
        // Resize
        imagecopyresized($thumb, $imorig, 0, 0, 0, 0, $e_width, $e_height, $width, $height);
        // Output
        ob_start();
        imagejpeg($thumb);
        $contents = ob_get_contents();
        ob_end_clean(); //End the output buffer.
        imagedestroy($thumb);
        return base64_encode($contents);
    }

}
