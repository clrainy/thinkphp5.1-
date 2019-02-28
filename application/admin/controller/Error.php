<?php
/**
 * Created by PhpStorm.
 * User: Rainy
 * Date: 2019/2/21
 * Time: 13:45
 */

namespace app\admin\controller;

use think\Controller;

class Error extends Controller
{
    public function _empty()
    {
        session(null);
        if (request()->isAjax()) {
            return json(['code' => -1, 'data' => [], 'msg' => $this->request->controller() . '为空控制器！']);
        }
        $this->assign([
            'msg' => $this->request->controller() . '为空控制器！'
        ]);
        return $this->fetch('error/error');
    }
}
