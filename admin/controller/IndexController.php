<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');
/**
 * Created by PhpStorm.
 * User: PGF
 * Date: 2015/5/20
 * Time: 15:58
 */
class IndexController extends Controller
{
    private $user;      //存放管理员信息
    //初始化，判断权限
    public function initialize()
    {
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

    //管理首页

    public function index()
    {
        view('Index/admin', $this->user);
    }

    //服务器状态
    public function station()
    {
        view('Index/station', $this->user);
    }

    //管理员管理
    public function admin_manage($action = false)
    {
        if ($action == false) {
            $data['admin'] = model('admin')->select()->leftjoin('admin_role', 'admin.roleid', 'admin_role.roleid')->query();
            $data['role'] = model('admin_role')->select()->query();
            view('Index/admin_manage', $data);
        } elseif ($action == 'edit') {           //=========修改管理员
            $status = array(
                'status' => true,
                'msg' => '修改成功'
            );
            if (isset($_POST['userid']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['roleid'])) {
                if(!isset($_POST['realname']))
                    $_POST['realname'] = $_POST['username'];
                $user = array(
                    'username' => $_POST['username'],
                    'email' => $_POST['email'],
                    'password' => $_POST['password'],
                    'roleid' => $_POST['roleid'],
                    'realname' => $_POST['realname']
                );
                //var_dump($this->user);exit;
                if($this->user['roleid']!=1 && $_POST['roleid'] == 1){
                    $status = array(
                        'status' => false,
                        'msg' => '系统默认超级管理员不可以更改！'
                    );
                }
                elseif ($_POST['userid'] == 1 && $_POST['roleid'] != 1) {
                    $status = array(
                        'status' => false,
                        'msg' => '系统默认超级管理员不可以更改！'
                    );
                } else {
                    if($this->user['username'] != $_POST['username']) {
                        $suser = model('admin')->selectuser($_POST['username']);
                        if(!empty($suser)){
                            $suser = $suser[0];
                            if($suser['userid']==$_POST['userid'])
                                $suser = array();
                        }
                    }else
                        $suser=array();
                    if(empty($suser)) {
                        if (model('admin')->edit($_POST['userid'], $user)===false) {
                            $status = array(
                                'status' => false,
                                'msg' => '修改失败，出现未知错误！'
                            );
                        }
                    }else{
                        $status = array(
                            'status' => false,
                            'msg' => '用户名已存在，请更换用户名！'
                        );
                    }
                }
            } else {
                $status = array(
                    'status' => false,
                    'msg' => '参数错误'
                );
            }
            echo json_encode($status);
            exit;
        } elseif ($action == 'del') {                //=========添加管理员
            $status = array(
                'status' => true,
                'msg' => '删除成功！'
            );
            if (isset($_POST['userid'])) {
                $userid = intval($_POST['userid']);
                if ($userid != 1) {
                    if (model('admin')->deladmin($userid)===false) {
                        $status = array(
                            'status' => false,
                            'msg' => '出现错误！'
                        );
                    }
                } else {
                    $status = array(
                        'status' => false,
                        'msg' => '系统默认的管理员不能删除！'
                    );
                }
            } else {
                $status = array(
                    'status' => true,
                    'msg' => '参数错误！'
                );
            }
            echo json_encode($status);
            exit;
        } elseif ($action == 'add') {                //=========添加管理员
            $status = array(
                'status' => true,
                'msg' => '添加成功'
            );
            if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['roleid'])) {
            	$suser = model('admin')->selectuser($_POST['username']);
            	if (empty($suser)) {
                    if(!isset($_POST['realname']))
                        $_POST['realname'] = $_POST['username'];
                    if (model('admin')->addadmin($_POST['username'], $_POST['password'], $_POST['roleid'], $_POST['email'], $_POST['realname'])===false) {
                        $status = array(
                            'status' => false,
                            'msg' => '系统出现错误，请联系超级管理员！'
                        );
                    }
                } else {
                    $status = array(
                        'status' => false,
                        'msg' => '要添加的管理员用户名以存在！'
                    );
                }

            } else {
                $status = array(
                    'status' => false,
                    'msg' => '参数错误'
                );
            }
            echo json_encode($status);
            exit;
        }
    }

    //==角色管理
    public function role($action = false)
    {
        if ($action == false) {
            $data['role'] = model('admin_role')->select()->query();
            view('Index/role', $data);
        } elseif ($action == 'edit') {
            $status = array(
                'status' => true,
                'msg' => '修改成功！'
            );
            if (isset($_POST['roleid']) && isset($_POST['rolename']) && isset($_POST['description'])) {
                $role = array(
                    'roleid' => $_POST['roleid'],
                    'rolename' => $_POST['rolename'],
                    'description' => $_POST['description']
                );
                if (model('admin_role')->edit($role)===false) {
                    $status = array(
                        'status' => false,
                        'msg' => '出现错误！'
                    );
                }
                echo json_encode($status);
                exit;
            } else {
                $status = array(
                    'status' => false,
                    'msg' => '参数错误！'
                );
                echo json_encode($status);
                exit;
            }
        } elseif ($action == 'add') {
            $status = array(
                'status' => true,
                'msg' => '添加成功！'
            );
            if (isset($_POST['rolename']) && isset($_POST['description'])) {
                $role = array(
                    'rolename' => $_POST['rolename'],
                    'description' => $_POST['description']
                );
                if (model('admin_role')->add($role)===false) {
                    $status = array(
                        'status' => false,
                        'msg' => '添加失败！'
                    );
                }
                echo json_encode($status);
                exit;
            }
        } elseif ($action == 'del') {
            $status = array(
                'status' => false,
                'msg' => '删除失败！'
            );
            if (isset($_POST['roleid'])) {
                if (model('admin_role')->del($_POST['roleid'])!==false) {
                    $status = array(
                        'status' => true,
                        'msg' => '删除成功！'
                    );
                }
                if ($_POST['roleid'] == 1)
                    $status = array(
                        'status' => false,
                        'msg' => '超级管理员不允许删除！'
                    );
                echo json_encode($status);
                exit;
            }
        } elseif ($action == 'editrole') {
            if (isset($_POST['roleid']) && !empty($_POST['roleid'])) {
                if (intval($_POST['roleid']) == 1) {
                    $var = array(
                        'error',
                        '修改失败',
                        '超级管理员权限不准修改！',
                        array('Index/role' => '返回角色修改')
                    );
                    redirect(Router::url('Index/role'), 2);
                    controller('Admin', 'show_message', $var);
                    exit;
                }
                if (model('admin_role')->editrole($_POST['roleid'], $_POST['menuid'])!==false) {
                    $var = array(
                        'ok',
                        '修改成功',
                        '角色权限修改成功！',
                        array('Index/role' => '返回角色修改')
                    );
                    cache::flush('admin/admin_menu');           //修改角色权限后更新后台菜单缓存
                    cache::flush('admin/admin_menu');           //修改角色权限后更新后台菜单缓存
                    redirect(Router::url('Index/role'), 2);
                    controller('Admin', 'show_message', $var);
                    exit;
                }
            }
        }
    }

    //===== 站点配置
    public function website_setting()
    {
        if (!empty($_POST)) {
            if (isset($_POST['title']) && isset($_POST['keywords']) && isset($_POST['description']) && isset($_POST['template'])) {
                //var_dump(model('website'));
                if (model('website')->set($_POST, $this->user['siteid'])!==false) {
                    $var = array(
                        'OK',
                        '站点信息修改成功',
                        '',
                        array('Index/website_setting' => '返回基本配置'),
                    );
                    controller('Admin', 'show_message', $var);
                }else{
                    $var = array(
                        'error',
                        '站点信息修改失败',
                        '',
                        array('Index/website_setting' => '返回基本配置'),
                    );
                    controller('Admin', 'show_message', $var);
                }
            }
        } else {
            $site = model('website')->where('siteid', '1')->getOne();
            view('Index/website_setting', $site);
        }
    }

    //===== 站点管理
    public function website_manage(){
        $site = model('website')->query();
        //var_dump($site);
        view('Index/website_manage', $site);
    }
    //===== 缓存处理
    public function flush_cache($type = 'all')
    {
        module('admin')->flush_cache($type);
    }

/*    public function test_fetch_html(){
        $content = file_get_contents('http://admin.com/index.php');
        $search = array(
            "/\<a([^\>]*) href\=\"\/index\.php\/Index\-content\-category\-(\d+)\.html\"([^\>]*)\>/" ,   //栏目
            "/\<a([^\>]*) href\=\"\/index\.php\/Index\-content\-page\-(\d+)\.html\"([^\>]*)\>/" ,       //单页面
            "/\<a([^\>]*) href\=\"\/index\.php\/Index\-content\-show\-(\d+)\-(\d+)\.html\"([^\>]*)\>/U" ,//详情页
        );
        $replace = array(
            "<a$1 href=\"/html/Category-$2.html\"$3>",           //栏目
            "<a$1 href=\"/html/Page-$2.html\"$3>",              //单页面
            "<a$1 href=\"/html/Show-$2-$3.html\"$4>",           //栏目
        );
        $content=preg_replace($search,$replace,$content);
        echo $content;
    }*/
}