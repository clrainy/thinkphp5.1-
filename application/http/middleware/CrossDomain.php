<?php

namespace app\http\middleware;

use think\Response;

class CrossDomain
{
    public function handle($request, \Closure $next)
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: Authorization, Content-Type, If-Match, If-Modified-Since, If-None-Match, If-Unmodified-Since, X-Requested-With, X-Access-Token, X-Token-Time');
        header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE');
        header('Access-Control-Max-Age: 1728000');

        if (strtoupper($request->method()) == "OPTIONS") {
            return Response::create()->send();
        }
//        dump($request);
        //域名白名单
        if (isset($_SERVER['HTTP_REFERER'])) {
            @$url = $_SERVER['HTTP_REFERER'];   //获取完整的来路URL
            return $next($request);
        } else {
            return $next($request);
//            return json(['code' => 1403, 'msg' => '1403：非法接口调用', 'date' => date('Y-m-d H:i:s', time())]);
        }
    }
}
