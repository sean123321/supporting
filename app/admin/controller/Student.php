<?php
/**
 * @author liutiecheng
 */
namespace app\admin\controller;
use app\admin\model\AdminUser as UserModel;
use app\admin\model\AdminTeacher as TeacherModel;
use app\admin\model\AdminStudent as StudentModel;
use app\admin\model\AdminStudenthome as StudenthomeModel;
use app\admin\model\AdminStudentImg as StudentImgModel;
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
class Student extends Admin
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
                'title' => '单个添加学生',
                'url' => 'admin/student/index',
            ],
            /*[
                'title' => '批量添加学生',
                'url' => 'admin/student/importSeacher',
            ],*/
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
            //$where['role_id'] = ['eq', "3"];
            if($login['role_id']==3 ){ //教师
                $where['user_id'] = ['eq', $login['uid']];

            }

            if($login['role_id']==4){//学校
                $where['school_id'] = ['eq', $login['school_id']];

            }

            $data['data'] = StudentModel::with(["school"])->where($where)->page($page)->limit($limit)->select();
            $data['count'] = StudentModel::where($where)->count('id');
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
     * 新增学生
     * @return mixed
     */
    public function addStudent()
    {
        $login = session('admin_user');
        if ($this->request->isPost()) {
            $data = $this->request->post();
            $student = array();
            $studentHome = array();
            $studentImg = array();
            foreach($data as $key=>$value){
                if(is_array($value)){
                    if($key=="ids")
                        $key = "id";
                    $studentHome[$key] = $value;
                }else{
                    $student[$key] = $value;
                }
            }
            // 验证
            $i =0;
            unset($data['id'],$studentHome['id']);
            $student['user_id'] = $login['uid'];
            StudentModel::startTrans();
            $studentId =StudentModel::create($student);
            if($studentId->getData('id')){
                $studentHomearr = [];
                foreach($studentHome as $key => $value){
                    foreach($value as $key1 => $value2){
                        $studentHomearr[$key1][$key] = $value2;
                        $studentHomearr[$key1]['student_id'] = $studentId->getData('id');
                    }
                }
                foreach ($this->uploadfile() as $key=>$value){
                    foreach ($value as $key1=>$value1){
                        $i++;
                        if($value1['msgCode']==0){
                            $studentImg[$i]['uid'] = $login['uid'];
                            $studentImg[$i]['model'] = $key;
                            $studentImg[$i]['url'] = $value1['url'];
                            $studentImg[$i]['student_id'] = $studentId->getData('id');

                        }
                    }
                }
                $studentImgMod = new StudentImgModel();
                if(!empty($studentImg)){
                    $sqlImg = $studentImgMod->SaveAll($studentImg);
                }else{
                    $sqlImg = 1;
                }
                if($sqlImg&&StudenthomeModel::insertAll($studentHomearr)){
                    StudentModel::commit();
                    return $this->success('添加成功');
                }
            }
            StudentModel::rollback();
            return $this->error('添加失败');

        }

        $tab_data = [];
        $tab_data['menu'] = [
            ['title' => '添加学生'],
        ];

        $list = array(
            array(
                'id'=>'',
                "student_id" =>'',
                "name" =>"",
                "homerelation" =>"",
                "age" => "",
                "workaddress"=>"",
                "mobile" =>"",
            )

        );
        $this->assign('menu_list', '');
        if($login['role_id']==3 || $login['role_id']==4){
            $this->assign('role_option', SchoolModel::getOptions($login['school_id']));
            $this->assign('teacher_name', $login['user_name']);

        }else{
            $this->assign('role_option', SchoolModel::getOption());
            $this->assign('teacher_name', '');

        }
        $this->assign('tab_data', $tab_data);
        $this->assign('tab_type', 2);
        $this->assign('listImg', $listImg=[]);

        $this->assign('student_link', $list);
        return $this->fetch('studentform');
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
    public function editStudent($id = 0)
    {
        $login = session('admin_user');

        if ($this->request->isPost()) {
            $data = $this->request->post();
            $student = array();
            $studentHome = array();
            $studentImg = array();
            $i =0;
            foreach ($this->uploadfile() as $key=>$value){
                foreach ($value as $key1=>$value1){
                    $i++;
                    if($value1['msgCode']==0){
                        if(isset($data[$key]['id'][$key1])){
                            $studentImg[$i]['id']  = $data[$key]['id'][$key1];
                        }
                        $studentImg[$i]['uid'] = $login['uid'];
                        $studentImg[$i]['model'] = $key;
                        $studentImg[$i]['url'] = $value1['url'];
                        $studentImg[$i]['student_id'] = $data['id'];

                    }else{
                        //删除图片状态逻辑
                        if(isset($data[$key]['id'][$key1]) && isset($data[$key]['delId'][$key1])){
                           if($data[$key]['delId'][$key1] == 0){
                               $studentImg[$i]['id']  = $data[$key]['id'][$key1];
                               $studentImg[$i]['code'] = $data[$key]['delId'][$key1];
                           }

                        }
                        //$studentImg[$i]['id']  = $data[$key]['id'][$key1];

                    }
                }
            }

            unset($data["home_img"]);
            unset($data["student_img"]);
            unset($data["img"]);
            foreach($data as $key=>$value){
                if(is_array($value)){
                    if($key=="ids")
                        $key = "id";
                    $studentHome[$key] = $value;
                }else{
                    $student[$key] = $value;
                }
            }

            StudentModel::startTrans();
            StudentModel::update($student);
            if($data['id']){
                $studentHomearr = [];
                foreach($studentHome as $key => $value){
                    foreach($value as $key1 => $value2){
                        $studentHomearr[$key1][$key] = $value2;
                        $studentHomearr[$key1]['student_id'] = $data['id'];
                    }
                }
                $Studenthome = new StudenthomeModel();
                $studentImgMod = new StudentImgModel();
                if(!empty($studentImg)){
                    $sqlImg = $studentImgMod->SaveAll($studentImg);
                }else{
                    $sqlImg = 1;
                }
                if($sqlImg&&$Studenthome->SaveAll($studentHomearr)){
                    StudentModel::commit();
                    return $this->success('修改成功');
                }
            }
            StudentModel::rollback();

            return $this->error('修改失败');
        }
        $row = StudentModel::where('id', $id)->find()->toArray();
        $student_link = StudenthomeModel::where('student_id', $id)->select();
        $where_home = [
            'student_id'=>$id,
            'code'=>1,
        ];
        $student_img = StudentImgModel::where($where_home)->select();
        $listImg = [];
        foreach($student_img as $key1=>$val){

            foreach ($val->toArray() as $key=>$value){
                if($key == 'url'){
                    $listImg[$key1][$key] = 'http://'.$_SERVER['HTTP_HOST'].DS.$value;
                }else{
                    $listImg[$key1][$key] = $value;
                }

            }

        }
        foreach($student_link as $val){
            $list[] = $val->toArray();
        }

        $tab_data = [];
        $tab_data['menu'] = [
            ['title' => '修改学生'],
        ];
        if($login['role_id']==3 || $login['role_id']==4){
            $this->assign('role_option', SchoolModel::getOptions($login['school_id']));
            $this->assign('teacher_name', $login['user_name']);

        }else{
           // $this->assign('role_option', SchoolModel::getOption());
            $this->assign('role_option', SchoolModel::getOption($row['school_id']));

            $this->assign('teacher_name', '');

        }
        //$this->assign('role_option', SchoolModel::getOption($row['school_id']));
        $this->assign('tab_data', $tab_data);
        $this->assign('data_info', $row);
        $this->assign('student_link', $list);
        $this->assign('listImg', $listImg);

        return $this->fetch('studentform');
    }

    public function showStudent($id = 0)
    {

        $row = StudentModel::where('id', $id)->find()->toArray();
        $student_link = StudenthomeModel::where('student_id', $id)->select();
        $where_home = [
            'student_id'=>$id,
            'code'=>1
        ];
        $student_img = StudentImgModel::where($where_home)->select();
        foreach($student_link as $val){
            $list[] = $val->toArray();
        }
        foreach($student_img as $key1=>$val){

            foreach ($val->toArray() as $key=>$value){
                if($key == 'url'){
                    $listImg[$key1][$key] = 'http://'.$_SERVER['HTTP_HOST'].DS.$value;
                }else{
                    $listImg[$key1][$key] = $value;
                }

            }

        }
        $tab_data = [];
        $tab_data['menu'] = [
            ['title' => '学生信息'],
        ];
        $this->assign('role_option', SchoolModel::getOption($row['school_id']));
        $this->assign('tab_data', $tab_data);
        $this->assign('data_info', $row);
        $this->assign('student_link', $list);
        $this->assign('listImg', $listImg);
        return $this->fetch('studentshow');
    }


    /**
     * 删除教师
     * @param int $id
     * @return mixed
     */
    public function delStudent()
    {
        $id = input('param.id/a');
        $model = new StudentModel();
        if (!$model->del($id)) {
            return $this->error($model->getError());
        }
        return $this->success('操作成功');
    }

    /**
     * 上传图片逻辑梳理上传数据梳理
     * 上传之后数组逻辑梳理
     */
    public function buildInfo(){
//     $info = $_FILES;
        
        foreach ($_FILES as $ke =>$v){//三维数组转换成2维数组
            $i = 0;
            if(is_string($v['name'])){ //单文件上传
                $info[$ke][$i] = $v;
                $i++;
            }else{ // 多文件上传
                foreach ($v['name'] as $key=>$val){//2维数组转换成1维数组
                    //取出一维数组的值，然后形成另一个数组
                    //新的数组的结构为：info=>i=>('name','size'.....)
                    $info[$ke][$i]['name'] = $v['name'][$key];
                    $info[$ke][$i]['size'] = $v['size'][$key];
                    $info[$ke][$i]['type'] = $v['type'][$key];
                    $info[$ke][$i]['tmp_name'] = $v['tmp_name'][$key];
                    $info[$ke][$i]['error'] = $v['error'][$key];
                    $i++;
                }
            }
        }
        return $info;
    }

    /**
     * 开始上传图片
     */

    public function uploadfile(){

        $infoArr = $this->buildInfo();
        $serArray=array();
        $img = array();
        foreach ($infoArr as $key=>$value){
            if(!empty($value)){
                array_push($serArray,$this->moveUplode($key,$value));
            }
        }
        foreach ($serArray as $key => $value){
            foreach ($value as $key1=>$value1){
                $img[$key1] = $value1;
            }

        }
        return $img;
    }

    public function getExt($filename)
    {
        $arr = explode('.',$filename);
        return array_pop($arr);;
    }

    public function getUniName($rand)
    {
        return time().$rand;
    }

    public function moveUplode($fileName,$infoArr,$path=ROOT_PATH ."upload",
                               $allowExt = array('png','jpg','jpeg','gif','mmp','qnmlgb'),
                               $maxSize=2048576,$imgFlag=true){
        $login = session('admin_user');
        $loginUid = $login['uid'];
        if (!file_exists($path.DS.$fileName.DS.$loginUid)) {
            mkdir($path.DS.$fileName.DS.$loginUid,0777,true);
        }
        $i = 0;
        $uploadedFiles = array();
        foreach ($infoArr as $val) {
            if ($val['error'] === UPLOAD_ERR_OK) {

                $ext = $this->getExt($val['name']);
                for($j=0;$j<count($allowExt);$j++){
                    if($ext == $allowExt[$j]){
                        $m = "此文件适合上传标准";
                        $h = $m;
                    }else {
                        $m = "此文件不可以被上传";
                    }
                }
                if($h){
                    $mes = "文件格式正确";
                }else{
                    $mes = "文件格式错误";
                    exit;
                }
                if($val['size']>$maxSize){
                    $mes = "文件太大了";
                    exit;
                }
                if($imgFlag){
                    $result = getimagesize($val['tmp_name']);
                    if(!$result){
                        $mes = "您上传的不是一个真正图片";
                        exit;
                    }
                }
                if(!is_uploaded_file($val['tmp_name'])){
                    $mes = "不是通过httppost传输的";
                    exit;
                }

                $realName = $this->getUniName($i).".".$ext;
                $destination = $path.DS.$fileName.DS.$loginUid.DS.$realName;
                if(move_uploaded_file($val['tmp_name'], $destination)){
                    $val['name'] = $realName;
                    //dump($val('error'));
                    if(!$val['error']){
                        $uploadedFiles[$fileName][$i]['msgCode']=$val['error'];
                        $uploadedFiles[$fileName][$i]['msg']='成功';
                        $destination = str_replace(ROOT_PATH, '', $destination);
                        $destination = str_replace(DS, '/', $destination);
                        $uploadedFiles[$fileName][$i]['url']=$destination;//?????????
                    }
                    unset($val['error'],$val['tmp_name'],$val['size'],$val['type']);


                }
            }else {
                switch ($val['error']) {
                    case 1: // UPLOAD_ERR_INI_SIZE
                        $mes = "超过配置文件中上传文件的大小";
                        break;
                    case 2: // UPLOAD_ERR_FORM_SIZE
                        $mes = "超过表单中配置文件的大小";
                        break;
                    case 3: // UPLOAD_ERR_PARTIAL
                        $mes = "文件被部分上传";
                        break;
                    case 4: // UPLOAD_ERR_NO_FILE
                        $mes = "没有文件被上传";
                        break;
                    case 6: // UPLOAD_ERR_NO_TMP_DIR
                        $mes = "没有找到临事文件目录";
                        break;
                    case 7: // UPLOAD_ERR_CANT_WRITE
                        $mes = "文件不可写";
                        break;
                    case 8: // UPLOAD_ERR_EXTENSION
                        $mes = "php扩展程序中断了上传程序";
                        break;
                }
                $uploadedFiles[$fileName][$i]['msgCode']=$val['error'];
                $uploadedFiles[$fileName][$i]['msg']=$mes;
                //echo $val['error'];
            }

            $i++;
        }
        return $uploadedFiles;
    }
}
