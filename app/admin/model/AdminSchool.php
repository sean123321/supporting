<?php
// +----------------------------------------------------------------------
// | HisiPHP框架[基于ThinkPHP5开发]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2018 http://www.hisiphp.com
// +----------------------------------------------------------------------
// | HisiPHP承诺基础框架永久免费开源，您可用于学习和商用，但必须保留软件版权信息。
// +----------------------------------------------------------------------
// | Author: 橘子俊 <364666827@qq.com>，开发者QQ群：50304283
// +----------------------------------------------------------------------
namespace app\admin\model;

use think\Model;
use app\admin\model\AdminSchool as SchoolModel;

/**
 * 后台用户模型
 * @package app\admin\model
 */
class AdminSchool extends Model
{
    // 定义时间戳字段名
    protected $createTime = 'ctime';
    protected $updateTime = 'mtime';

    // 自动写入时间戳
    protected $autoWriteTimestamp = true;

    /**
     * 获取所有学校(下拉列)
     * @param int $id 选中的ID
     * @return string
     */
    public static function getOptions($id = 0)
    {
        $rows = self::column('id,title');
        $str = '<option value="">请选择</option>';
        foreach ($rows as $k => $v) {

            if ($id == $k) {
                $str .= '<option value="'.$k.'" selected>'.$v.'</option>';
            } else {
                //$str .= '<option value="'.$k.'">'.$v.'</option>';
            }
        }
        return $str;
    }

    public static function getOption($id = 0)
    {
        $rows = self::column('id,title');
        $str = '<option value="">请选择</option>';
        foreach ($rows as $k => $v) {

            if ($id == $k) {
                $str .= '<option value="'.$k.'" selected>'.$v.'</option>';
            } else {
                $str .= '<option value="'.$k.'">'.$v.'</option>';
            }
        }
        return $str;
    }

    /**
     * 删除用户
     * @param string $id 用户ID
     * @return bool
     */
    public function del($id = 0)
    {
        if (is_array($id)) {
            $error = '';
            foreach ($id as $k => $v) {


                if ($v <= 0) {
                    $error .= '参数传递错误['.$v.']！<br>';
                    continue;
                }

                $map = [];
                $map['id'] = $v;
                // 删除用户
                self::where($map)->delete();

            }

            if ($error) {
                $this->error = $error;
                return false;
            }
        } else {
            $id = (int)$id;
            if ($id <= 0) {
                $this->error = '参数传递错误！';
                return false;
            }


            $map = [];
            $map['id'] = $id;
            // 删除学校
            self::where($map)->delete();
        }

        return true;
    }

}
