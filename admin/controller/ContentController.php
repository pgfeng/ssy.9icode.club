<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');
/**
 * Created by PhpStorm.
 * User: PGF
 * Date: 2015/8/6
 * Time: 11:02
 */

class ContentController extends Controller{
    private $user;

    //初始化，判断权限
    public function initialize(){
        $user = model('admin')->checklogin();
        $config = array(
            'hidden_entry' => false
        );
        Config::set($config,'router');
        if ($user == false) {
            header('Location:'.Router::url('Admin/login'));
            exit;
        } else {
            if (empty($user[0]['realname']))
                $user[0]['realname'] = $user[0]['username'];
            $this->user = $user[0];
            module('admin')->checkrole($this->user['roleid']);
        }
    }
    /**
     * 栏目管理
     * @param string $action 操作行为
     */
    public function category($action='manage'){
        module('admin')->getviewList('content','page');
        $data=array();
        if($action=='manage'){                  //管理栏目
            $category = module('category')->manage_categogry_list();
            $data['category']=$category;
            view('Content/category_manage',$data);
        }elseif($action=='add'){                //添加栏目
            $data['action'] = 'add';
            $data['parent'] =isset($_REQUEST['parent'])?$_REQUEST['parent']:0;
            $data['cid'] = 0;
            if(isset($_REQUEST['mid']) && $_REQUEST['mid']!='' && $_REQUEST['mid']>0) {           //判断是否存在一个栏目模型ID
                if(isset($_POST['add_category']))                                              //判断是否已经提交
                {
                    unset($_POST['add_category']);
                    module('category')->add($_POST);
                }else{
                    $data['mid'] = intval($_REQUEST['mid']);
                    $data['model']=module('admin')->getCategoryModel(intval($_REQUEST['mid']));
                    $data['cmodel'] = module('admin')->getContentModel(intval($_REQUEST['cmid']));
                    $data['type'] = 'category';
                    $data['type'] = $data['cmodel']['is_page']==1?'page':$data['type'];

                    if(empty($data['model']) || empty($data['model'])){
                        echo '你选择的栏目模型或者内容模型不存在！';
                        exit;
                    }
                    $data['model']=$data['model'];
                    $data['mid']=$data['model']['modelid'];
                    $data['cmid']=$data['cmodel']['modelid'];
                    $field=model('model_field')->field_list($data['model']['modelid']);
                    $data['field']=$field;
                }
            }else{                                              //获取栏目模型和内容模型
                $data['model']=module('admin')->getCategoryModel();
                $data['cmodel'] = module('admin')->getContentModel();
            }
            view('Content/category_add',$data);
        }elseif($action=='edit'){                               //编辑栏目
            $data['action']=$action;
            if(isset($_REQUEST['cid'])){
                if(isset($_POST['edit_category'])){
                    unset($_POST['edit_category']);
                    module('category')->edit($_POST);
                }else{
                    $res=model('category')->where('cid',intval($_REQUEST['cid']))->getOne('con_modelid,cat_modelid,parent');
                    $_REQUEST['mid']  = $res['cat_modelid'];
                    $_REQUEST['cmid'] = $res['con_modelid'];
                    $data['cid']=intval($_REQUEST['cid']);
                    $data['parent'] = $res['parent'];unset($res);
                    $data['model']=module('admin')->getCategoryModel(intval($_REQUEST['mid']));
                    $data['cmodel'] = module('admin')->getContentModel(intval($_REQUEST['cmid']));
                    //var_dump($data['cmodel']);
                    $data['type'] = 'category';
                    $data['type'] = $data['cmodel']['is_page']==1?'page':$data['type'];
                    if(empty($data['model']) || empty($data['model'])){
                        echo '你选择的栏目模型或者内容模型不存在！';
                        exit;
                    }
                    $data['model']=$data['model'];
                    $data['mid']=$data['model']['modelid'];
                    $data['cid']=$_REQUEST['cid'];
                    $data['cmid']=$data['cmodel']['modelid'];
                    $field=model('model_field')->field_list($data['model']['modelid']);
                    $data['field']=$field;
                    view('Content/category_add',$data);
                }
            }
        }elseif($action=='del'){
            $this->delCategory();
        }elseif($action=='editListorder'){
            $this->editCategoryListorder();
        }
    }
    private function editCategoryListorder(){
        if(isset($_POST['cid'])&&isset($_POST['listorder'])){
            $status=array(
                'status' => true,
                'msg'    => '修改成功！'
            );
            $update=array(
                'listorder' => intval($_POST['listorder'])
            );
            if(model('category')->where('cid',intval($_POST['cid']))->update($update)){
                echo json_encode($status);
                exit;
            }
        }
    }
    private function delCategory(){
        if(isset($_POST['cid']))
        {
            $status=array(
                'status' => true,
                'msg'    => '删除成功！'
            );
            if(model('category')->del($_POST['cid'])!==false){
                echo json_encode($status);
                exit;
            }else{
                $status=array(
                    'status' => false,
                    'msg'    => '删除失败！'
                );
                echo json_encode($status);
                exit;
            }
        }else {
            $status = array(
                'status' => false,
                'msg' => '参数缺失！'
            );
            echo json_encode($status);
            exit;
        }
    }
    public function content($method){
        if($method=='manage'){
            if(!isset($_REQUEST['cid'])){
                $this->chose_category('manage');
            }else{
                $category = model('category')->where('cid',intval($_GET['cid']))->getOne();
                if(empty($category)){
                    $var = array(
                        'error',
                        '你选择的栏目不存在',
                        '页面正在返回中，请稍后。。。',
                        array('Content/content/manage' => '返回选择栏目'),
                        'Content/content/manage'
                    );
                    redirect(Router::url('Content/content/manage'), 2);
                    controller('Admin', 'show_message', $var);
                    exit;
                }else{
                    Module('content')->showManage($_GET['cid']);
                }
            }
        }else if($method=='add'){
            $cid = isset($_REQUEST['cid'])?$_REQUEST['cid']:0;
            if($cid>0)
                $this->add_content($_REQUEST['cid']);
            else{
                $this->chose_category('add');
            }
        }else if($method=='edit'){
            $cid = isset($_REQUEST['cid'])?intval($_REQUEST['cid']):false;
            $id  = isset($_REQUEST['id'])?intval(($_REQUEST['id'])):false;
            if($cid && $id)
                $this->edit_content($cid, $id);
            else
                exit('请求参数不完整！');
        }else if($method=='editListorder'){
            if(isset($_POST['cid']) && isset($_POST['id']) && isset($_POST['listorder'])){
                $category = model('category')->where('cid',intval($_POST['cid']))->getOne('contable');
                if(model($category['contable'])->where('id',intval($_POST['id']))->update(array('listorder'=>intval($_POST['listorder'])))){
                    $status=array(
                        'status' => true,
                        'msg'    => '修改成功！'
                    );
                }else{
                    $status=array(
                        'status' => false,
                        'msg'    => '出现未知错误！'
                    );
                }

            }else{
                $status=array(
                    'status' => false,
                    'msg'    => '传入的参数不完整！'
                );
            }
            echo json_encode($status);
            exit;
        }else if($method=='del'){
            if(isset($_POST['cid']) && isset($_POST['id'])){
                $aid = explode(',',$_POST['id']);
                if($aid[0]==''){
                    $status = array(
                            'status' => false,
                            'msg'    => '没有选择内容,请选择后再删除！'
                        );
                    echo json_encode($status);
                    exit;
                }
                foreach($aid as $id) {
                    if(!empty($id)) {
                        $id = intval($id);
                        $category = model('category')->where('cid', intval($_POST['cid']))->getOne('contable');
                        if (model($category['contable'])->where('id', $id)->delete()) {
                            $status = array(
                                'status' => true,
                                'msg' => '删除成功！'
                            );
                        } else {
                            $status = array(
                                'status' => false,
                                'msg' => '出现未知错误！'
                            );
                            break;
                        }
                    }
                }
            }else{
                $status=array(
                    'status' => false,
                    'msg'    => '传入的参数不完整！'
                );
            }
            echo json_encode($status);
            exit;
        }
    }
    //单网页管理
    public function page($action='add'){
        if($action=='chose_model'){
            $data['model'] = model('model')->where('is_page',1)->query();
            view('Content/chose_page_model', $data);
        }elseif($action=='add'){
            if(!isset($_REQUEST['mid'])){
                $data['model'] = model('model')->where('is_page',1)->query();
                view('Content/chose_page_model', $data);
                exit;
            }
            $data['action'] = 'add';
            $data['parent'] =isset($_REQUEST['parent'])?$_REQUEST['parent']:0;
            $data['cid'] = 0;
            $data['model'] = model('model')->where('modelid', intval($_REQUEST['mid']))->where('is_page',1)->getOne();
            if(isset($_POST['add_category']))                                              //判断是否已经提交
            {
                unset($_POST['add_category']);
                module('category')->add($_POST);
            }else{
                $data['type'] = 'page';
                if(empty($data['model'])){
                    echo '我擦嘞，你都将单网页模型删了，还添加毛线单网页啊。。。';
                    exit;
                }
                $data['mid'] = $data['model']['modelid'];
                $field = model('model_field')->field_list($data['model']['modelid']);
                $data['field'] = $field;
            }
            view('Content/category_add',$data);
        }elseif($action == 'edit'){                                                      //单网页编辑
            $data['action']='edit';
            if(isset($_REQUEST['cid'])){
                if(isset($_POST['edit_category'])){
                    unset($_POST['edit_category']);
                    module('category')->edit($_POST,'page');
                }else {
                    $data['type'] = 'page';
                    $cid = intval($_REQUEST['cid']);
                    $categoty = model('category')->where('cid', $cid)->getOne();
                    $data['mid'] = $categoty['cat_modelid'];
                    $data['cid'] = $cid;
                    $data['parent'] = $categoty['parent'];
                    $data['model'] = model($categoty['catetable'])->where('id', $categoty['catid'])->getOne();
                    $model = model('model')->where('modelid', $categoty['cat_modelid'])->where('is_page', 1)->getOne('is_page,name');
                    if (empty($model)) {
                        $var = array(
                            'error',
                            '出错了，模型并不存在！',
                            '页面正在返回中，请稍后。。。',
                            array('Content/category/manage' => '返回栏目管理'),
                            'Content/category/manage'
                        );
                        redirect(Router::url('Content/category/manage'), 2);
                        controller('Admin', 'show_message', $var);
                        exit;
                    }
                    $data['model']['name'] = $model['name'];
                    $data['model']['is_page'] = $model['is_page'];
                    $field = model('model_field')->field_list($categoty['cat_modelid']);
                    $data['field'] = $field;
                    view('Content/category_add', $data);
                }
            }else{
                $var = array(
                    'error',
                    '出错了，我不知道你要修改那个单页面！',
                    '页面正在返回中，请稍后。。。',
                    array('Content/category/manage' => '返回栏目管理'),
                    'Content/category/manage'
                );
                redirect(Router::url('Content/category/manage'), 2);
                controller('Admin', 'show_message', $var);
                exit;
            }
        }
    }

    //选择栏目
    private function chose_category($type='manage'){
        $data['type'] = $type;
        view('Content/chose_category',$data);
    }

    //添加内容
    private function add_content($cid){
        $cid=intval($cid);
        if(isset($_POST['add_content']))
        {
            if(isset($_POST['mid'])){
                module('content')->add($_POST['cid'],$_POST['mid']);
            }else{
                exit('参数不完整！');
            }
        }else {
            $category = model('category')->where('cid', $cid)->getOne();
            $catname = model($category['catetable'])->where('id', $category['catid'])->getOne('catname');
            $catname = $catname[0];
            $category['catname'] = $catname;
            unset($catname);
            $model = model('model')->where('modelid',$category['cat_modelid'])->getOne('modelid,is_page');
            $category['is_page'] = $model['is_page'];
            $category['modelid'] = $model['modelid'];
            $data['type'] = 'content';
            if ($category['is_page'] == 0) {
                $data['field'] = model('model_field')->field_list($category['con_modelid']);
            } else {
                exit('不可以在网页下添加内容哟！');
            }
            $data['category'] = $category;
            $data['action']='add';
            $data['type']='content';
            $data['id']  = false;
            //print_r($category);
            view('Content/content_add', $data);
        }
    }

    //修改内容
    private function edit_content($cid, $id){
        if(isset($_POST['edit_content'])){
            if(isset($_POST['mid']) && isset($_POST['id'])){
                module('content')->edit($_POST['cid'],$_POST['id'],$_POST['mid']);
            }else{
                exit('请求的参数不完整');
            }
        }else {
            $cid = intval($cid);
            $id = intval($id);
            $data['id']=$id;
            $data['action']='edit';
            $category = model('category')->where('cid', $cid)->getOne();
            $catname = model($category['catetable'])->where('id', $category['catid'])->getOne('catname');
            $catname = $catname[0];
            $category['catname'] = $catname;
            unset($catname);
            $model = model('model')->where('modelid',$category['cat_modelid'])->getOne('modelid,is_page');
            $category['is_page'] = $model['is_page'];
            $category['modelid'] = $model['modelid'];
            $data['type'] = 'content';
            if ($category['is_page'] == 0) {
                $data['field'] = model('model_field')->field_list($category['con_modelid']);
            } else {
                exit('不可以在网页下添加内容哟！');
            }
            $data['category'] = $category;
            //print_r($category);
            view('Content/content_add', $data);
        }
    }

    //----附件管理
    /**
     * @param string $action
     * @param string $type
     * @param int $page
     */
    public function attach($action='manage', $type='all',$page=1){
        if($action=='manage'){
            $page = intval($page);
            $listNum = 10;  //列表数量
            if($type=='all')
                $atm = model('attaches');
            elseif($type=='image')
                $atm = model('attaches')->where('attachtype','image');
            elseif($type=='file')
                $atm = model('attaches')->where('attachtype','file');
            elseif($type=='flash')
                $atm = model('attaches')->where('attachtype','flash');
            elseif($type=='media')
                $atm = model('attaches')->where('attachtype','media');
            else
                $atm = model('attaches')->where('attachtype','image');
            $select = array(        //要获取的字段
                'admin.realname',
                'admin.username',
                'attaches.*'
            );
            $atm->leftJoin('admin','admin.userid','attaches.userid')->select($select);
            $atm1 = clone $atm;     //克隆模型
            $count = $atm->count();
            $pager = Loader::plugin('page');
            $pager->init($count,Router::$router->url('Content/attach/manage/'.$type.'/%page%'),$page,$listNum);
            $pres = $pager->p();
            $data = array();
            $data['attaches'] = $atm1->limit($pres['min'],$listNum)->query();
            $data['pager']   = $pres['html'];
            $this->assign($data);
            $this->display('Content/attach');
        }elseif($action=='del'){
            $status = array(
                'status' => 'error',
                'msg'    => '您没有选择附件！'
            );
            if(!isset($_POST['attacheid'])){
                echo json_encode($status);exit;
            }else{
                $attacheid = explode(',',$_POST['attacheid']);
                $root = substr(__ROOT__,0,strlen(__ROOT__)-1);
                foreach($attacheid as $id) {
                    if($id!='')
                        $id = intval($id);
                    else
                        continue;
                    $attach = model('attaches')->where('attachid',$id)->getOne('attachpath,attachname');
                    //var_dump($attach);
                    if(unlink($root.$attach['attachpath'])){
                        if(model('attaches')->where('attachid',$id)->delete()){
                            $status = array(
                                'status' => 'info',
                                'msg'    => '附件'.$attach['attachname'].'删除成功!'
                            );
                            //echo json_encode($status);exit;
                        }else{
                            $status = array(
                                'status' => 'error',
                                'msg'    => '附件'.$attach['attachname'].'数据库删除失败!'
                            );
                            echo json_encode($status);exit;
                        }
                    }else{
                        $status = array(
                            'status' => 'error',
                            'msg'    => '附件从磁盘中'.$attach['attachname'].'删除失败!'
                        );
                        echo json_encode($status);exit;
                    }
                }
                if(count($attacheid)>1){
                    $status['msg'] = '您选中的附件删除成功了！';
                }
                $path = __ROOT__.Config::cms('upload_path');
                /**
                 * 清除空文件夹
                 * @param $path
                 */
                function rm_empty_dir($path){
                    if(is_dir($path) && ($handle = opendir($path))!==false){
                        while(($file=readdir($handle))!==false){     // 遍历文件夹
                            if($file!='.' && $file!='..'){
                                $curfile = $path.'/'.$file;          // 当前目录
                                if(is_dir($curfile)){                // 目录
                                    rm_empty_dir($curfile);          // 如果是目录则继续遍历
                                    if(count(scandir($curfile))==2){ // 目录为空,=2是因为. 和 ..存在
                                        rmdir($curfile);             // 删除空目录
                                    }
                                }
                            }
                        }
                        closedir($handle);
                    }
                }
                rm_empty_dir($path);
                echo json_encode($status);exit;
            }
        }
    }

    ///---- 搜索栏目
    public function serchCate(){
        if(isset($_GET['s'])) {
            $model = model('category');
            $res = $model->search($_GET['s']);
            $result = array();
            $res1 = array();
            foreach($res as $r){
                $res1['cid'] = $r['cid'];
                $res1['catname'] = $r['catname'];
                $result[] = $res1;
            }
            unset($res);
            $result = array(
                'message' => "",
                'value' => $result,
                'code' => 200,
                'redirect' => ''
            );

            echo json_encode($result);
            exit;
        }else{
            exit;
        }
    }
    //----附件上传
    public function upload(){
    if(!isset($_GET['fieldid'])){
        $status = array('error'=>1,'message'=>'参数有误！');
        json_encode($status);exit;
    }
    $_GET['fieldid'] = intval($_GET['fieldid']);
    $field = model('model_field')->where('fieldid',$_GET['fieldid'])->getOne();
    if(empty($field)){
        $status = array('error'=>1,'message'=>'参数有误！');
        json_encode($status);exit;
    }
    if($field['formtype']=='editor'){
        $ext_arr = array(
            'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
            'flash' => array('swf', 'flv'),
            'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
            'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2'),
        );
    }else if($field['formtype']=='picture' || $field['formtype']=='pictures'){
        $field['setting'] = unserialize($field['setting']);
        $type = explode('|', $field['setting']['p_allow_type']);
        $ext_arr = array(
                'image' => $type,
                'flash' => array(),
                'media' => array(),
                'file'  => array()
            );
    }else if($field['formtype']=='file'){
        $field['setting'] = unserialize($field['setting']);
        $type = explode('|', $field['setting']['f_allow_type']);
        $ext_arr = array(
                'image' => array(),
                'flash' => array(),
                'media' => array(),
                'file'  => $type
            );
    }else{
        $status = array('error'=>1,'message'=>'此字段不允许上传文件！');
        echo json_encode($status);exit;
    }
    //var_dump($field);exit;
    $save_path = __ROOT__.Config::cms('upload_path');
    $max_size = 40000000;
    $status = array('error'=>1,'message'=>"参数不完整！");
        if(isset($_FILES['imgFile'])){
            if (!empty($_FILES['imgFile']['error'])) {
                switch($_FILES['imgFile']['error']){
                    case '1':
                        $error = '超过php.ini允许的大小。';
                        break;
                    case '2':
                        $error = '超过表单允许的大小。';
                        break;
                    case '3':
                        $error = '图片只有部分被上传。';
                        break;
                    case '4':
                        $error = '请选择图片。';
                        break;
                    case '6':
                        $error = '找不到临时目录。';
                        break;
                    case '7':
                        $error = '写文件到硬盘出错。';
                        break;
                    case '8':
                        $error = 'File upload stopped by extension。';
                        break;
                    case '999':
                    default:
                        $error = '未知错误。';
                }
                $status['message'] = $error;unset($error);
                echo json_encode($status);exit;
            }
            if (empty($_FILES) === false) {     //有上传文件
                //原文件名
                $file_name = $_FILES['imgFile']['name'];
                //服务器上临时文件名
                $tmp_name = $_FILES['imgFile']['tmp_name'];
                //文件大小
                $file_size = $_FILES['imgFile']['size'];
                //检查文件名
                if (!$file_name) {
                    $status['message'] = "请选择文件。";
                    echo json_encode($status);exit;
                }

                //检查目录
                if (@is_dir($save_path) === false) {
                    $status['message'] = "上传目录不存在。";
                    echo json_encode($status);exit;
                }
                //检查目录写权限
                if (@is_writable($save_path) === false) {
                    $status['message'] = "上传目录没有写权限。";
                    echo json_encode($status);exit;
                }
                //检查是否已上传
                if (@is_uploaded_file($tmp_name) === false) {
                    $status['message'] = "上传失败。";
                    echo json_encode($status);exit;
                }
                //检查文件大小
                if ($file_size > $max_size) {
                    $status['message'] = "上传文件大小超过限制。";
                    echo json_encode($status);exit;
                }
                //检查目录名
                $dir_name = empty($_GET['dir']) ? 'image' : trim($_GET['dir']);
                if (empty($ext_arr[$dir_name])) {
                    $status['message'] = "目录名不正确。";
                    echo json_encode($status);exit;
                }
                //获得文件扩展名
                $temp_arr = explode(".", $file_name);
                $file_ext = array_pop($temp_arr);
                $file_ext = trim($file_ext);
                $file_ext = strtolower($file_ext);
                //检查扩展名
                if (in_array($file_ext, $ext_arr[$dir_name]) === false) {
                    $status['message'] = "上传文件扩展名是不允许的扩展名。\n只允许" . implode(",", $ext_arr[$dir_name]) . "格式。";
                    echo json_encode($status);exit;
                }
                //创建文件夹
                if ($dir_name !== '') {
                    $save_path .= $dir_name . "/";
                    $save_url = Config::cms('upload_url').$dir_name . "/";
                    if (!file_exists($save_path)) {
                        mkdir($save_path);
                    }
                }
                $ymd = date("Ymd");
                $save_path .= $ymd . "/";
                $save_url .= $ymd . "/";
                if (!file_exists($save_path)) {
                    mkdir($save_path);
                }
                //新文件名
                $new_file_name = date("YmdHis") . '_' . rand(10000, 99999) . '.' . $file_ext;
                //移动文件
                $file_path = $save_path . $new_file_name;
                if (move_uploaded_file($tmp_name, $file_path) === false) {
                    $status['message'] = "上传文件失败。";
                    echo json_encode($status);exit;
                }
                @chmod($file_path, 0644);
                $file_url = $save_url . $new_file_name;
                $attach = array(
                    'attachname' => $file_name,
                    'attachsize' => $file_size,
                    'attachtype' => $dir_name,
                    'attachtime' => time(),
                    'attachpath' => $file_url,
                    'userid'     => $this->user['userid']
                );
                model('attaches')->insert($attach);
                echo json_encode(array('error' => 0, 'url' => $file_url));
                exit;
            }
        }
        echo json_encode($status);
        exit;
    }

    /**
     * tags 管理
     */
    public function tags($action='manage'){
        if($action=='manage'){
            echo 'tags管理';
            view('Content/tags');
        }
    }
}