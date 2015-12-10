<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');
/**
 * Created by PhpStorm.
 * User: pgf
 * Date: 15-9-5
 * Time: 上午9:30
 */
class PackageController extends Controller{
    public function initialize(){
        Controller('Index');
    }
    public function run($mark = false){
        if($mark == false){
            exit('不知道你要做什么….…');
        }else{
            include(__ROOT__.'expand/'.$mark.'/adminMain.php');
        }
    }
    public function install(){
        view('Package/install');
    }
}