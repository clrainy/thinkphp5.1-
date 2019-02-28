<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**
 * 将字符解析成数组
 * @param $str
 */
function parseParams($str)
{
    $arrParams = [];
    parse_str(html_entity_decode(urldecode($str)), $arrParams);
    return $arrParams;
}
/**
 * 整理菜单方法
 * @param $param
 * @return array
 */
function prepareMenu($param)
{
    $parent = []; //父类
    $child = [];  //子类

    foreach ($param as $key => $vo) {

        if ($vo['typeid'] == 0) {
            $vo['href'] = '#';
            $parent[] = $vo;
        } else {
            $vo['href'] = url($vo['control_name'] . '/' . $vo['action_name']); //跳转地址
            $child[] = $vo;
        }
    }

    foreach ($parent as $key => $vo) {
        foreach ($child as $k => $v) {
            if ($v['typeid'] == $vo['id']) {
                $parent[$key]['child'][] = $v;
            }
        }
    }
    unset($child);

    return $parent;
}
/**
 * 递归实现无限层极
 * @param $data
 * @param $pId
 * @return array|string
 *方法$tree = getTree($data, 0);
 */
function getTree($data, $pId)
{
    $tree = [];
    foreach($data as $k => $v)
    {
        if($v['typeid'] == $pId)
        {        //父亲找到儿子
            $v['child'] = getTree($data, $v['id']);
            //如果子元素为空则unset()进行删除，说明已经到该分支的最后一个元素了（可选）
            if($pId ==0){
                $v['href'] = '#';
            }else{
                $v['href'] = url($v['control_name'] . '/' . $v['action_name']);
            }
            if($v['child'] == null){
                unset($v['child']);
            }

            $tree[] = $v;
        }
    }
    return $tree;
}
/**
 * 生成随机数
 * @param int $lenght
 * @return bool|string
 */
function randomStr($lenght = 32)
{
    $str_pol = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789abcdefghijklmnopqrstuvwxyz";
    return substr(str_shuffle($str_pol), 0, $lenght);
}


/**
 * 生成AccessToken
 * @return string
 */
function makeAccessToken()
{
    $access_token = md5(randomStr(28) . time());
    return strtoupper($access_token);
}
