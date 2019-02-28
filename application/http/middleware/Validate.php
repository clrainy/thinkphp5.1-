<?php
/**
 * Created by PhpStorm.
 * User: Rainy
 * Date: 2018/11/7
 * Time: 11:01
 */

namespace app\http\middleware;

use think\Controller;

class Validate extends Controller
{
    /**
     * 默认返回资源类型
     * @var \think\Request $request
     * @var mixed $next
     * @var string $name
     * @throws \Exception
     * @return mixed
     */
    public function handle($request, \Closure $next, $name)
    {
        $params = $request->param();
        $module = $request->module();
        $controller = ucfirst($request->controller());
        $scene = $request->action();//获取操作名,用于验证场景scene(*********这里系统会强制转小写字母)

        if ($controller == 'Miss') { // 路由为空
            return $next($request);
        }
// 因为存在版本控制 层级的目录，故无法直接获取到完整的控制器
//        $pathinfo = $request->pathinfo();
//        $controller = explode('/',$pathinfo);
//        $controller = ucfirst($controller[1]);
//        $scene    = $request->routeInfo()['route'];//获取操作名,用于验证场景scene
        $validate = "app\\" . $module . "\\validate\\" . $controller;
//        dump($request->action());
        //仅当验证器存在时 进行校验
        if (class_exists($validate)) {
            $v = $this->app->validate($validate);
            if ($v->hasScene($scene)) {
                //仅当存在验证场景才校验
                $result = $this->validate($params, $validate . '.' . $scene);
                if (true !== $result) {
                    //校验不通过则直接返回错误信息
                    return json(['code' => -1, 'msg' => $result, 'date' => date('Y-m-d H:i:s', time())]);
                }
            }
        }
        return $next($request);
    }
}