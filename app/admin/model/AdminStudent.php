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

use app\admin\model\AdminStudenthome as Studenthome;


/**
 * 后台用户模型
 * @package app\admin\model
 */
class AdminStudent extends Model
{
    public function school()
    {
        return $this->hasOne('AdminSchool', 'id', 'school_id');

    }

    public function studenthome()
    {
        return $this->hasOne('AdminStudenthome', 'student_id', 'id');

    }

    /**
     * 删除用户
     * @param string $id 用户ID
     * @return bool
     */
    public function del($id = 0)
    {
        $Studenthome = new Studenthome();
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
                // 删除关联表;
                $Studenthome->delUser($v);

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
            // 删除关联表;
            $Studenthome->delUser($id);
        }

        return true;
    }


}
