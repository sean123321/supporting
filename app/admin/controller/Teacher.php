<?php
/**
 * @author liutiecheng
 */
namespace app\admin\controller;
use app\admin\model\AdminUser as UserModel;
use app\admin\model\AdminTeacher as TeacherModel;
use app\admin\model\AdminRole as RoleModel;
use app\admin\model\AdminSchool as SchoolModel;
use think\File;
use PHPExcel_IOFactory;
use PHPExcel;
use PHPExcel_Cell;
use think\Validate;

/**
 * 后台用户
 * @package app\admin\controller
 */
class Teacher extends Admin
{
    public $tab_data = [];
    /**
     * 初始化方法
     */
    protected function _initialize()
    {
        parent::_initialize();

        $tab_data['menu'] = [
            [
                'title' => '单个添加教师',
                'url' => 'admin/teacher/index',
            ],
            [
                'title' => '批量添加教师',
                'url' => 'admin/teacher/importTeacher',
            ],
        ];
        $this->tab_data = $tab_data;
    }

    /**
     * 教师管理
     * @return mixed
     */
    public function index($q = '')
    {
        $login = session('admin_user');
        if ($this->request->isAjax()) {
            $where = $data = [];
            $page = input('param.page/d', 1);
            $limit = input('param.limit/d', 15);
            $keyword = input('param.keyword');
            if ($keyword) {
                $where['username'] = ['like', "%{$keyword}%"];
            }
            //$where['id'] = ['neq', 1];
            $where['role_id'] = ['eq', "3"];

            if($login['role_id']==4){//学校
                $where['school_id'] = ['eq', $login['school_id']];

            }

            $data['data'] = UserModel::with(['role','school'])->where($where)->page($page)->limit($limit)->select();
            $data['count'] = UserModel::where($where)->count('id');
            $data['code'] = 0;
            $data['msg'] = '';
            return json($data);
        }

        // 分页
        $tab_data = $this->tab_data;
        $tab_data['current'] = url('');

        $this->assign('tab_data', $tab_data);
        $this->assign('tab_type', 1);
        return $this->fetch();
    }


    /**
     * 新增教师
     * @return mixed
     */
    public function addTeacher()
    {
        $login = session('admin_user');

        if ($this->request->isPost()) {
            $data = $this->request->post();
            $data['role_id'] = 3;
            $data['password'] = 123456;
            $data['password_confirm'] = 123456;

            // 验证
            /*$title = $data['title'];
            $row = SchoolModel::where('title', $title)->field('id,title')->find();

            if($row){
                return $this->error('不能重复添加');
            }*/

            unset($data['id'], $data['password_confirm']);
            $data['last_login_ip'] = '';
            $data['auth'] = '';
            if (!UserModel::create($data)) {
                return $this->error('添加失败');
            }
            return $this->success('添加成功');
        }

        $tab_data = [];
        $tab_data['menu'] = [
            ['title' => '添加教师'],
        ];
        $this->assign('menu_list', '');
        if($login['role_id']==3 || $login['role_id']==4) {

            $this->assign('role_option', SchoolModel::getOptions($login['school_id']));
        }else{
            $this->assign('role_option', SchoolModel::getOption());

        }
        $this->assign('tab_data', $tab_data);
        $this->assign('tab_type', 2);
        return $this->fetch('teacherform');
    }

    /**
     *phpexcel 导入excel
     */
    public function importTeacher()
    {
        $UserMod = new UserModel();
        if($file = request()->file('excelfile')) {

            // 上传附件路径
            $group = 'teacher';
            $ext = 'xls';
            $type =$file->checkExt($ext);
            $size = $file->checkSize(1024*1024*2);
            if (empty($file)) {
                return $this->error('未找到文件');
            }
            if(!$type){
                return $this->error('请用xls后缀的文件');
            }

            if(!$size){
                return $this->error('文件大小不能超过2M');
            }

            $_upload_path = ROOT_PATH . 'upload' . DS . $group . DS . $ext . DS;
            $upfile = $file->rule('date')->move($_upload_path);
            //dump($upfile->getSaveName());
            $new_path = $_upload_path.$upfile->getSaveName();
            if($upfile){
                $data =$this ->imporExcel($_upload_path.$upfile->getSaveName());
                $insertData = [];
                if(!empty($data)){
                    foreach($data as $key=>$value){
                        $row = SchoolModel::where('title', $value[0])->field('id,title')->find();
                        $insertData[] = ['school_id'=>$row['id'],
                                         'username'=>$value[1],
                                         'nick'=>$value[2],
                                         'email'=>$value[3],
                                         'mobile'=>$value[4],
                                         'birthday'=>$value[5],
                                         'role_id'=>3,
                                         'password'=>$UserMod->setPasswordAttr(123456),
                                         'status'=>1];
                    }

                }

                unset($upfile);
                unlink($new_path);
                if(UserModel::insertAll($insertData)){
                    //删除上传文件
                    return $this->success('上传成功');
                }else{
                    return $this->error('存在已上传学校或者系统问题，请检查学校是否已存在');

                }

            }

        }
        $tab_data = [];
        $tab_data['menu'] = [
            ['title' => '批量导入学校'],
        ];
        return $this->fetch('importteacherform');
    }

    public function imporExcel($file)
    {
        $objReader = PHPExcel_IOFactory::createReader('Excel5');//use 2007 for 2007 format
        $objPHPExcel = $objReader->load($file);
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow(); // 取得总行数
        $highestColumn = $sheet->getHighestColumn(); // 取得总列数
        $objWorksheet = $objPHPExcel->getActiveSheet();
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

        $excelData = array();
        for ($row = 2; $row <= $highestRow; $row++) {
            for ($col = 0; $col < $highestColumnIndex; $col++) {
                $excelData[$row][] =(string)$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
            }
        }

        return $excelData;

    }

    /**
     * 修改教师
     * @param int $id
     * @return mixed
     */
    public function editTeacher($id = 0)
    {
        $login = session('admin_user');

        if ($this->request->isPost()) {
            $data = $this->request->post();
            if (!UserModel::update($data)) {
                return $this->error('修改失败');
            }
            return $this->success('修改成功');
        }

        $row = UserModel::where('id', $id)->find()->toArray();

        $tab_data = [];
        $tab_data['menu'] = [
            ['title' => '修改学校'],
        ];
        if($login['role_id']==3 || $login['role_id']==4) {

            $this->assign('role_option', SchoolModel::getOptions($login['school_id']));
        }else{
            $this->assign('role_option', SchoolModel::getOption($row['school_id']));

        }
        $this->assign('tab_data', $tab_data);
        $this->assign('data_info', $row);
        return $this->fetch('teacherform');
    }



    /**
     * 删除教师
     * @param int $id
     * @return mixed
     */
    public function delTeacher()
    {
        $id = input('param.id/a');
        $model = new UserModel();
        if (!$model->del($id)) {
            return $this->error($model->getError());
        }
        return $this->success('操作成功');
    }


}
