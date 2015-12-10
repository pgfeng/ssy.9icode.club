<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');

/**
 * Class MemberController
 * 用户管理
 */
class MemberController extends Controller{
    public function initialize(){
        Controller('Index');        //使用Index的initialize
    }
    //=========用户组管理
    public function group($action='manage'){
        if($action=='manage'){              //====管理
            $group = model('member_group')->query();
			$data['group'] = $group;
            view('Member/group',$data);
        }elseif($action=='add'){           //=====添加
            if(isset($_POST['groupname'])&&isset($_POST['description'])){
                $group = array(
                    'groupname'   => $_POST['groupname'],
                    'description' => $_POST['description']
                );
                $res = model('member_group')->add($group);
            }else{
            	$status = array(
					'status'=>'error',
					'msg'   =>'请求参数有误！'
				);
            }
            echo json_encode($res);exit;
        }elseif($action=='edit'){
        	if(isset($_POST['groupname']) && isset($_POST['description']) && isset($_POST['groupid'])){
                $group = array(
                        'groupid'       => $_POST['groupid'],
                        'groupname'     => $_POST['groupname'],
                        'description'   => $_POST['description']
                    );
                $res = model('member_group')->edit($group);
                echo json_encode($res);exit;
            }
        }elseif($action=='del'){
            if(isset($_POST['groupid'])){
                $group = explode(',',$_POST['groupid']);
                model('member_group')->del($group);
                $status = array(
                    'status'    => 'success',
                    'msg'       => '删除成功！'
                );
            }else{
                $status = array(
                    'status'    => 'error',
                    'msg'       => '请传入正确的参数！'
                );
            }
            echo json_encode($status);exit;
        }
    }
    //==========用户管理
    public function manage(){
        echo "用户管理";
        view('Member/manage');
    }
    public function model(){
        $array = array(
                'IN' => 'A',
                'DA' => 'B',
                'AE' => 'C'
            );
        //model('model')->ADD();
    }
}