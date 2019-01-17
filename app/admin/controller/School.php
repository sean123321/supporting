<?php
/**
 * @author liutiecheng
 */
namespace app\admin\controller;
use app\admin\model\AdminUser as UserModel;
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
class School extends Admin
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
                'title' => '单个添加学校',
                'url' => 'admin/school/index',
            ],
            [
                'title' => '批量添加学校',
                'url' => 'admin/school/importSchool',
            ],
        ];
        $this->tab_data = $tab_data;
    }

    /**
     * 学校管理
     * @return mixed
     */
    public function index($q = '')
    {
        if ($this->request->isAjax()) {
            $where = $data = [];
            $page = input('param.page/d', 1);
            $limit = input('param.limit/d', 15);
            $keyword = input('param.keyword');
            if ($keyword) {
                $where['title'] = ['like', "%{$keyword}%"];
            }
            //$where['id'] = ['neq', 1];
            $data['data'] = SchoolModel::where($where)->page($page)->limit($limit)->select();
            $data['count'] = SchoolModel::where($where)->count('id');
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
     * 新增学校
     * @return mixed
     */
    public function addSchool()
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();
            // 验证
            $title = $data['title'];
            $row = SchoolModel::where('title', $title)->field('id,title')->find();

            if($row){
                return $this->error('不能重复添加');
            }

            unset($data['id']);
            if (!SchoolModel::create($data)) {
                return $this->error('添加失败');
            }
            return $this->success('添加成功');
        }

        $tab_data = [];
        $tab_data['menu'] = [
            ['title' => '添加学校'],
        ];

        $this->assign('menu_list', '');
        $this->assign('role_option', RoleModel::getOption());
        $this->assign('tab_data', $tab_data);
        $this->assign('tab_type', 2);
        return $this->fetch('schoolform');
    }

    /**
     *phpexcel 导入excel
     */
    public function importSchool()
    {
        if($file = request()->file('excelfile')) {

            // 上传附件路径
            $group = 'school';
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
                        if(empty($row)){
                            $insertData[] = ['title'=>$value[0],'status'=>1];
                        }
                    }

                }

                unset($upfile);
                unlink($new_path);
                if(SchoolModel::insertAll($insertData)){
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
        return $this->fetch('importschoolform');
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
     * 修改学校
     * @param int $id
     * @author 橘子俊 <364666827@qq.com>
     * @return mixed
     */
    public function editSchool($id = 0)
    {

        if ($this->request->isPost()) {
            $data = $this->request->post();

            if (!SchoolModel::update($data)) {
                return $this->error('修改失败');
            }
            return $this->success('修改成功');
        }

        $row = SchoolModel::where('id', $id)->field('id,title,status')->find()->toArray();

        $tab_data = [];
        $tab_data['menu'] = [
            ['title' => '修改学校'],
        ];


        $this->assign('tab_data', $tab_data);
        $this->assign('data_info', $row);
        return $this->fetch('schoolform');
    }



    /**
     * 删除用户
     * @param int $id
     * @author 橘子俊 <364666827@qq.com>
     * @return mixed
     */
    public function delSchool()
    {
        $id = input('param.id/a');
        $model = new SchoolModel();
        if (!$model->del($id)) {
            return $this->error($model->getError());
        }
        return $this->success('操作成功');
    }


}
