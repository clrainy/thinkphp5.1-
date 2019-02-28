<?php
/**
 * Created by PhpStorm.
 * User: Rainy
 * Date: 2018/11/10
 * Time: 9:35
 */

namespace app\common\model;

use Exception;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\exception\DbException;
use think\Model;

class BaseModel extends Model
{

    /**
     * 获取全部
     * @param $where
     * @param $offset
     * @param $length
     * @return array|\PDOStatement|string|\think\Collection
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public function getAll($field, $where, $order, $offset, $length)
    {
        try {
            return $this->field($field)->where($where)->order($order)->limit($offset, $length)->select();
        } catch ( Exception  $e ) {
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    /**
     * @param $field
     * @param $where
     * @return array|\PDOStatement|string|\think\Collection
     */
    public function getFieldAll($field, $where)
    {
        try {
            return $this->field($field)->where($where)->select();
        } catch ( Exception  $e ) {
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    /**
     * 获取一个
     * @param $field
     * @param $where
     * @return array|null|\PDOStatement|string|Model
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public function getOne($field, $where)
    {
        try {
            return $this->field($field)->where($where)->find();
        } catch ( Exception  $e ) {
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    /**
     * 获取某条记录指定的字段值
     * @param $field
     * @param $id
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public function getFieldOne($field, $sn)
    {
        try {
            $flag = $this->field($field)->where('sn', $sn)->find();
            return $flag[$field];
        } catch ( Exception  $e ) {
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    /**
     * 获取数量
     * @param $where
     * @return array|float|string
     */
    public function getCount($where)
    {
        try {
            return $this->where($where)->count();
        } catch ( Exception  $e ) {
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    /**
     * 求和
     * @param $where
     * @return array|float|string
     */
    public function getSum($where, $field)
    {
        try {
            return $this->where($where)->sum($field);
        } catch ( Exception  $e ) {
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    /**
     * 求最大
     * @param $where
     * @return array|float|string
     */
    public function getMax($where, $field)
    {
        try {
            return $this->where($where)->max($field);
        } catch ( Exception  $e ) {
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    /**
     * 添加
     * @param $data
     * @return array
     */
    public function getAdd($data)
    {
        try {
            $this->allowField(true)->save($data);
        } catch ( DbException $e ) {
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    /**
     * 编辑
     * @param $data
     * @param $where
     * @return array
     */
    public function getEdit($data, $where)
    {
        try {
            $this->allowField(true)->save($data, $where);
        } catch ( DbException $e ) {
            return json(['code' => -2, 'data' => '', 'msg' => $e->getMessage()]);
        }
    }

    /**
     * 删除
     * @param $where
     * @return array
     * @throws \Exception
     */
    public function getDel($where)
    {
        try {
            $result = $this->where($where)->delete();
            if ($result) {
                return ['code' => 0, 'data' => '', 'msg' => '操作成功！'];
            } else {
                return ['code' => -1, 'data' => '', 'msg' => '操作失败！'];
            }
        } catch ( DbException $e ) {
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    /**
     * @param $sn
     * @return \think\response\Json
     */
    public function deleteId($sn)
    {
        try {
            $this->save(['status' => -3, 'delete_time' => time()], ['sn' => $sn]);
        } catch ( DbException $e ) {
            return json(['code' => -2, 'data' => '', 'msg' => $e->getMessage()]);
        }
    }

    /*
 * 一对一关联
 */
    public function role()
    {
        return $this->hasOne('Role', 'id', 'role_id')->field('id,rolename,sn');
    }
}