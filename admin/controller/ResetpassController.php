<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');
class ResetpassController extends Controller{
	//-------超级管理员重置
    function index(){
    	$user = array(
    		'username' => 'admin',
    		'password' => 'admin123321'
    		);
    	if(model('admin')->edit('1',$user)){
    		echo '重置成功';
    	}else{
    		echo '重置失败';
    	}
    }
}