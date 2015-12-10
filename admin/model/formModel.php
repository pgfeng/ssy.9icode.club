<?php
/**
 * Created by PhpStorm.
 * User: pgf
 * Date: 15-8-28
 * Time: 上午11:05
 */
class formModel extends Model{
    //添加自定义表单
    function add($formname, $formsetting, $checkcode=0){
        $form = array(
            'formname'    => $formname,
            'formsetting' => serialize($formsetting),
            'checkcode'   => $checkcode
        );
        $form = $this->addslashes($form);
        if($this->insert($form)){
            $formid = $this->getOne('max(formid)');
            $formid = $formid['max(formid)'];
            $get    = array(
                'formid' => $formid
            );
            $get = serialize($get);
            $menu=array(
                'action' => 'Form/manage',
                'getArray'    => $get,
                'parentmenuid'=> 101,
                'menuname'    => $form['formname'],
                'markname'    => 'content'
            );
            model('admin_menu')->insert($menu);
            cache::flush('admin');
            return true;
        }else{
            return false;
        }
    }
    function get($formid=false){
        if($formid == false) {
            $res = $this->query();
            $form = array();
            foreach($res as $field){
                $f['formid']   = $field['formid'];
                $f['formname'] = $field['formname'];
                //$f['checkcode'] = $field['checkcode'];
                $f['formsetting'] = unserialize($field['formsetting']);
                $form[]=$f;
            }
            return $form;
        }else{
            $form = $this->where('formid', intval($formid))->getOne();
            $form['formsetting'] = unserialize($form['formsetting']);
            return $form;
        }
    }
    function edit($formid, $form){
        $formname = $this->where('formid',$formid)->getOne('formname');
        $formname = $formname['formname'];
        $form['formsetting']=serialize($form['formsetting']);
        if($this->where('formid',intval($formid))->update($form)){      //更新
            return true;
        }else{
            return false;
        }
    }
    function del($formid){
        $formid = intval($formid);
        $formname = $this->where('formid',$formid)->getOne('formname');
        $formname = $formname['formname'];
        if(model('admin_menu')->where('action','Form/manage')->where('menuname',$formname)->delete()){
            if($this->where('formid',$formid)->delete()){
                model('form_content')->where('formid',$formid)->delete();
            }
        }
        cache::flush('admin/admin_menu');
        return true;
    }
}