<?php
/**
 * Created by PhpStorm.
 * User: Rainy
 * Date: 2018/11/7
 * Time: 10:03
 */
namespace app\http\middleware;

use think\Request;
/**
 * 访问环境检查，是否是微信或支付宝等
 */
class InAppCheck
{
    public function handle(Request $request, \Closure $next)
    {
        if (preg_match('~micromessenger~i', $request->header('user-agent'))) {
            $request->InApp = 'WeChat';
        } else if (preg_match('~alipay~i', $request->header('user-agent'))) {
            $request->InApp = 'Alipay';
        }else{
            $request->InApp = '浏览器';
        }
        return $next($request);
    }
}