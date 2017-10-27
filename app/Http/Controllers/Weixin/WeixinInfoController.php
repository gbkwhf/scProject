<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/27
 * Time: 9:50
 */

namespace App\Http\Controllers\Weixin;

use App\Http\Controllers\Controller;
use Acme\Exceptions\ValidationErrorException;
use Illuminate\Http\Request;
use App\Http\Requests;


/**
 * Class WeixinInfoController
 * @package App\Http\Controllers\Weixin
 * 该控制器主要用于完成微信公众号功能的开发
 */
class WeixinInfoController  extends Controller{



    //获取openId
    public function getOpenId(Request $request){

        $validator = $this->setRules([
            'code' => 'string', //非必填
        ])
            ->_validate($request->all());

        if (!$validator) throw new ValidationErrorException;


        $code = empty($request->code) ? "" : $request->code;

        $appId = getenv('appId');
        $appSecret = getenv('appSecret');

//        $jssdk = new JSSDK($appId,$appSecret);
//
//        print_r($jssdk->getJsApiTicket());

        $wxPay = new JsApiPay();

        print_r($wxPay->GetOpenid($code));


    }


    private function http_request($url)
    {

        //初始化
        $ch = curl_init();
        //设置选项，包括URL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        //执行并获取HTML文档内容
        $output = curl_exec($ch);
        //释放curl句柄
        curl_close($ch);
        //打印获得的数据
        print_r($output);


    }








}