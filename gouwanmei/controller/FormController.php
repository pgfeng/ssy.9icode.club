<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');
/**
 * Created by PhpStorm.
 * User: pgf
 * Date: 15-9-7
 * Time: 下午2:42
 */
class FormController extends Controller{
    private $formname = '';
    private $formid;
    //引入初始化
    public function initialize(){
        //获取站点配置
        if(!isset($_SERVER['QUERY_STRING']))
            $_SERVER['QUERY_STRING'] = '';
        $setting = model('setting')->where('siteid',1)->getOne();
        $data['SEO'] = array();
        $data['SEO']['title']       = $setting['title'];
        $data['SEO']['keywords']    = $setting['keywords'];
        $data['SEO']['description'] = $setting['description'];
        $template = $setting['template'];           //站点配置中的前台模板
        $data['page'] = isset($_GET['page'])?$_GET['page']:1;
        $this->assign($data);
        unset($setting);
        Config::set(array('cache'=>1),'database');
        Config::template();                                 //载入模板配置，防止将所有的配置替换
        //==配置模板风格和静态缓存生存时间
        Config::set(array('view_name'=>$template,'template_parse'=>'template_parse','view_cache'=>Config::cms('view_cache'),'leftDelim'=>Config::cms('tpl_leftDelim'),'rightDelim'=>Config::cms('tpl_rightDelim')),'template');
        Loader::func('gouwanmei');
        //error_reporting(1);
        Config::set(array('debug'=>0),'config');
    }

    public function submit(){
        $formid  = isset($_REQUEST['formid'])?intval($_REQUEST['formid']):false;
        $form = model('form')->where('formid',$formid)->getOne();
        if($form['checkcode']==1){
            if(!isset($_REQUEST['checkcode']))
            {
                $status = array(
                    'status' => 'false',
                    'msg'    => '需要验证码！'
                );
            }
        }else{
            if($_REQUEST['checkcode']!=$_SESSION['code'])
            {
                $status = array(
                    'status' => 'false',
                    'msg'    => '验证码不正确！'
                );
                return $this->Freturn($status);
            }
            if(empty($form))
            {
                $status = array(
                    'status' => 'false',
                    'msg'    => '请仔细检查表单是否存在！'
                );
                return $this->Freturn($status);
            }
            $this->formname = $formname = $form['formname'];
            $this->formid = $formid;
            $formField = unserialize($form['formsetting']);
            $ip=ip();
            $lastsubmitform = model('form_content')->where('fid',$formid)->where('time>'.(time()-20))->getOne();
            if(!empty($lastsubmitform)){
                $status = array(
                    'status' => false,
                    'msg'    => '对不起，您已经提交过'.$formname.'了！'
                );
                return $this->Freturn($status);
            }
            if(!$formid){
                $status = array(
                    'status' => false,
                    'msg'    => '参数不完整，缺少formid！'
                );
                return $this->Freturn($status);
            }else{
                unset($form);
                foreach($formField as $field){
                    if(!isset($_REQUEST[$field]))
                    {
                        $status = array(
                            'status' => false,
                            'msg'    => '参数'.$field.'不存在！'
                        );
                        return $this->Freturn($status);
                    }else{
                        $form[$field]=$_REQUEST[$field];
                    }
                }
                $form = serialize($form);
            }
            $insert = array(
                'fid'  => $formid,
                'time' => time(),
                'value'=> $form,
                'ip'   => ip()
            );
            if(model('form_content')->insert($insert)) {
                $status = array(
                    'status' => true,
                    'msg' => $formname . '提交成功了！'
                );
            }else{
                $status = array(
                    'status' => false,
                    'msg'    => '出现未知错误！'
                );
            }
        }
        return $this->Freturn($status);
    }

    //==判断是否返回json
    private function Freturn($status){
        $is_ajax = isset($_REQUEST['is_ajax'])?($_REQUEST['is_ajax']!=false?true:false):false;
        if($is_ajax)
            return $this->returnJson($status);
        else
            return $this->returnHtml($status);
    }
    //==返回Json
    private function returnJson($status){
        echo json_encode($status);exit;
    }
    //==返回
    private function returnHtml($status){
        
        $data = array();
        $data['status']   = $status['status'];
        $data['msg']      = $status['msg'];
        $data['formname'] = $this->formname;
        $data['formid']   = $this->formid;
        $this->assign('formname',$this->formname);
        $this->assign('formid',$this->formid);
        view('Form/submitStatus',$data);
    }
}