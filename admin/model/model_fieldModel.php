<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');
/**
 * Created by PhpStorm.
 * User: PGF
 * Date: 2015/7/6
 * Time: 17:33
 */
class model_fieldModel extends Model
{
    private function parseField($model_id,$field){
        $ffield=array();
        $field['is_index'] = intval($field['is_index']) == 1?1:0;
        $field['is_null'] = intval($field['is_null']) == 1?1:0;
        if ($field['formtype'] == 'title' || $field['formtype'] == 'text') {
            $ffield = array(
                'modelid'    => $model_id,
                'name'       => $field['name'],
                'tname'      => $field['tname'],
                'pattern'    => $field['regexp'],
                'errortips'  => $field['errortip'],
                'formtype'   => $field['formtype'],
                'is_null'    => $field['is_null'],
                'is_index'   => $field['is_index']
            );
            //转存字段对表单的设置
            $ffield['setting']=array();
            if($field['min_length']>0)
                $ffield['setting']['min_length'] = intval($field['min_length']);
            if($field['max_length']>0)
                $ffield['setting']['max_length'] = intval($field['max_length']);
            if($field['input_value']!=='')
                $ffield['setting']['input_value']= $field['input_value'];
            if($field['input_width']!=='')
                $ffield['setting']['input_width']= $field['input_width'];
            if($field['input_height']!=='')
                $ffield['setting']['input_height']= $field['input_height'];
            if($field['placeholder']!=='')
                $ffield['setting']['placeholder']= $field['placeholder'];
        }elseif($field['formtype'] == 'textarea'){
            $ffield = array(
                'modelid'     => $model_id,
                'name'        => $field['name'],
                'tname'       => $field['tname'],
                'pattern'     => $field['regexp'],
                'errortips'   => $field['errortip'],
                'formtype'    => $field['formtype'],
                'is_null'     => $field['is_null'],
                'is_index'    => $field['is_index']
            );

            $ffield['setting']=array();
            if($field['min_length']>0)
                $ffield['setting']['min_length'] = intval($field['min_length']);
            if($field['max_length']>0)
                $ffield['setting']['max_length'] = intval($field['max_length']);
            if($field['input_value']!=='')
                $ffield['setting']['input_value']= $field['input_value'];
            if($field['textarea_height']!='')
                $ffield['setting']['textarea_height'] = $field['textarea_height'];
            if($field['textarea_width']!='')
                $ffield['setting']['textarea_width'] = $field['textarea_width'];
            if($field['placeholder']!=='')
                $ffield['setting']['placeholder']= $field['placeholder'];
        }elseif($field['formtype'] == 'editor'){
            $ffield = array(
                'modelid'     => $model_id,
                'name'        => $field['name'],
                'tname'       => $field['tname'],
                'formtype'    => $field['formtype'],
                'is_null'     => $field['is_null'],
                'is_index'    => $field['is_index']
            );
            $ffield['setting']=array();
            if($field['input_value']!=='')
                $ffield['setting']['input_value']= $field['input_value'];
            if($field['editor_height']!=='')
                $ffield['setting']['editor_height']= $field['editor_height'];
            if($field['editor_width']!='')
                $ffield['setting']['editor_width'] = $field['editor_width'];
        }elseif($field['formtype'] == 'picture' || $field['formtype'] == 'pictures'){
            $ffield = array(
                'modelid'     => $model_id,
                'name'        => $field['name'],
                'tname'       => $field['tname'],
                'formtype'    => $field['formtype'],
                'is_null'     => $field['is_null'],
                'is_index'    => $field['is_index']
            );
            $ffield['setting']=array();
            if($field['p_allow_type']!='')
                $ffield['setting']['p_allow_type']= $field['p_allow_type'];
        }elseif($field['formtype'] == 'file' || $field['formtype'] == 'files'){
            $ffield = array(
                'modelid'     => $model_id,
                'name'        => $field['name'],
                'tname'       => $field['tname'],
                'formtype'    => $field['formtype'],
                'is_null'     => $field['is_null'],
                'is_index'    => $field['is_index']
            );
            $ffield['setting']=array();
            if($field['f_allow_type']!=='')
                $ffield['setting']['f_allow_type']= $field['f_allow_type'];
        }elseif($field['formtype'] == 'date'){
            $ffield = array(
                'modelid'     => $model_id,
                'name'        => $field['name'],
                'tname'       => $field['tname'],
                'formtype'    => $field['formtype'],
                'is_null'     => $field['is_null'],
                'is_index'    => $field['is_index']
            );
            $ffield['setting'] = array();
//            $ffield['setting']['start_time']=strtotime("Y-m-d",$field['start_time']);
//            $ffield['setting']['end_time']=strtotime("Y-m-d",$field['end_time']);

        }elseif($field['formtype'] == 'areaSelect'){
            $ffield = array(
                'modelid'     => $model_id,
                'name'        => $field['name'],
                'tname'       => $field['tname'],
                'formtype'    => $field['formtype'],
                'is_null'     => $field['is_null'],
                'is_index'    => $field['is_index']
            );
            $ffield['setting']['areaSelectLevel'] = $field['areaSelectLevel'];
        }elseif($field['formtype'] == 'tags'){
            $ffield = array(
                'modelid'     => $model_id,
                'name'        => $field['name'],
                'tname'       => $field['tname'],
                'formtype'    => $field['formtype'],
                'is_null'     => $field['is_null'],
                'is_index'    => $field['is_index']
            );
            $ffield['setting'] = array();
            if(isset($field['tags_width']))
                $ffield['setting']['tags_width'] = $field['tags_width'];
            if(isset($field['tags_height']))
                $ffield['setting']['tags_height'] = $field['tags_height'];
        }
        $ffield['is_system'] = isset($field['is_system'])?$field['is_system']:0;
        unset($field);
        $ffield['setting'] = serialize($ffield['setting']);
        return $ffield;
    }
    public function parsedbType($formtype){
        if($formtype == 'title' || $formtype=='text'){
            return ' VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL';
        }elseif($formtype == 'textarea' || $formtype == 'editor'){
            return ' LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL';
        }elseif($formtype == 'picture' || $formtype == 'file'){
            return ' VARCHAR( 512 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL';
        }elseif($formtype == 'pictures' || $formtype == 'files'){
            return ' TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL';
        }elseif($formtype == 'areaSelect'){
            return ' VARCHAR(11) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL';
        }elseif($formtype == 'date'){
            return ' date DEFAULT \'0000-00-00\'';
        }elseif($formtype == 'tags'){
            return ' VARCHAR(512) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL';
        }
    }

    /**
     * @param $fieldid      字段ID
     * @param $field        提交过来的字段
     * @return int          返回模型ID
     */
    public function edit($fieldid,$field){
        $ffield  = $this->where('fieldid',intval($fieldid))->leftJoin('model','model.modelid','model_field.modelid')->getOne(array('model.tablename as tablename','model_field.*'));
        $field   = $this->addslashes($field);
        $table   = Config::database('table_pre').'module_'.$ffield['tablename'];
        $noindex = array(
            'textarea',
            'editor',
            'pictures'
        );
        if($field['name']!=$ffield['name'])
        {
            $sql = 'alter table '.$table.' change '.$ffield['name'].' '.$field['name'].$this->parsedbType($field['formtype']);
        }else{
            //echo $ffield['is_index'];
            //-- LONGTEXT不允许存在索引，删除索引
            if(($field['formtype']=='textarea'||$field['formtype']=='editor')&&$ffield['is_index']==1){
                $field['is_index'] = 0;         //将表单提交过来的索引改为否
            }
            $sql = 'alter table '.$table.' modify '.$ffield['name'].$this->parsedbType($field['formtype']);
        }

        //echo $field['formtype'];
        if($this->exec($sql)===false){
            return false;
        }
        $field = $this->parseField($ffield['modelid'],$field);
        unset($field['modelid']);
        if($field['is_index']==1){
            if(!in_array($field['formtype'], $noindex))
            {
                $sql = 'ALTER TABLE  ' . $table . ' ADD INDEX (' . $field['name'] . ')';
                $this->exec($sql);
            }
        }elseif($ffield['is_index']==1){
            if(!in_array($field['formtype'], $noindex))
            {
                $sql = 'ALTER TABLE '.$table.' DROP INDEX '.$ffield['name'];
                $this->exec($sql);
            }
        }
        $this->where('fieldid',intval($fieldid))->update($field);
        return $ffield['modelid'];
    }

    /**
     * @param $model_id     模型ID
     * @param $field
     * @return bool
     */
    public function add($model_id, $field){
        $msg=array(
            'status' => true,
            'msg'    => '字段添加成功！'
        );
        $ufield = array(
            'url',
            'cid',
            'inputtime',
            'updatetime',
            'template',
            'id'
        );
        if(in_array($field['name'],$ufield)){
            $msg = array(
                'status' => false,
                'msg'    => '此字段已经存在，请更换字段!'
            );
            return $msg;
        }
        $field = $this->addslashes($field);
        //echo $field['formtype'];exit;
        if (isset($field['formtype']) && !empty($field['formtype'])) {
            $field['is_index'] = intval($field['is_index']) == 1?1:0;
            $field['is_null'] = intval($field['is_null']) == 1?1:0;
            $insert = $this->parseField($model_id, $field);
            $module=model('model')->where('modelid',intval($model_id))->getOne();
            $table = Config::database('table_pre').'module_'.$module['tablename'];
            if($this->where('name',$field['name'])->where('modelid', $model_id)->getOne())
            {
                $msg=array(
                    'status' => false,
                    'msg'    => '此字段已存在，请修改字段名！'
                );
                return $msg;
            }
            if($field['formtype']=='title' || $field['formtype']=='text')
            {
                $sql = 'ALTER TABLE ' . $table . ' ADD ' . $field['name'] . $this->parsedbType($field['formtype']);
                if($this->exec($sql)!==false){
                    $this->insert($insert);
                }else{
                    $msg = array(
                        'status' => false,
                        'msg'    => '可能字段是数据库保留字，请更换字段!'
                    );
                    return $msg;
                }
                if ($field['input_value']) {
                    $sql = "ALTER TABLE {$table} CHANGE {$field['name']} {$field['name']} VARCHAR( 512 )  DEFAULT  '{$field['input_value']}'";
                    $this->exec($sql);
                }
            }elseif($field['formtype']=='textarea' ||$field['formtype']=='editor') {
                $sql = 'ALTER TABLE ' . $table . ' ADD ' . $field['name'] . $this->parsedbType($field['formtype']);
                if($this->exec($sql)!==false){
                    $this->insert($insert);
                }else{

                    $msg = array(
                        'status' => false,
                        'msg'    => '可能字段是数据库保留字，请更换字段!'
                    );
                    return $msg;
                }
                if ($field['input_value']) {
                    $sql = "ALTER TABLE {$table} CHANGE {$field['name']} {$field['name']} LONGTEXT  DEFAULT  '{$field['input_value']}'";
                    $this->exec($sql);
                }
            }elseif($field['formtype']=='picture'||$field['formtype']=='file') {
                $sql = 'ALTER TABLE ' . $table . ' ADD ' . $field['name'] . $this->parsedbType($field['formtype']);
                if($this->exec($sql)!==false){
                    $this->insert($insert);
                }else{

                    $msg = array(
                        'status' => false,
                        'msg'    => '可能字段是数据库保留字，请更换字段!'
                    );
                    return $msg;
                }
            }elseif($field['formtype']=='pictures') {
                $sql = 'ALTER TABLE ' . $table . ' ADD ' . $field['name'] . $this->parsedbType($field['formtype']);
                if($this->exec($sql)!==false){
                    $this->insert($insert);
                }else{

                    $msg = array(
                        'status' => false,
                        'msg'    => '可能字段是数据库保留字，请更换字段!'
                    );
                    return $msg;
                }
            }elseif($field['formtype']=='areaSelect'){
                $sql = 'ALTER TABLE ' . $table . ' ADD ' . $field['name'] . $this->parsedbType($field['formtype']);
                //var_dump($insert);exit;
                if($this->exec($sql)!==false){//修改表
                    $this->insert($insert); //添加字段
                }else{

                    $msg = array(
                        'status' => false,
                        'msg'    => '可能字段是数据库保留字，请更换字段!'
                    );
                    return $msg;
                }
            }elseif($field['formtype']=='date'){
                $sql = 'ALTER TABLE ' . $table . ' ADD ' . $field['name'] . $this->parsedbType($field['formtype']);
                if($this->exec($sql)!==false){
                    $this->insert($insert);
                }else{

                    $msg = array(
                        'status' => false,
                        'msg'    => '可能字段是数据库保留字，请更换字段!'
                    );
                    return $msg;
                }
            }elseif($field['formtype']=='tags'){
                $sql = 'ALTER TABLE ' . $table . ' ADD ' . $field['name'] . $this->parsedbType($field['formtype']);
                if($this->exec($sql)!==false){
                    $this->insert($insert);
                }else{

                    $msg = array(
                        'status' => false,
                        'msg'    => '可能字段是数据库保留字，请更换字段!'
                    );
                    return $msg;
                }
            }
            //-----排除掉不可以为索引的字段
            $noindex = array(
                    'textarea',
                    'editor',
                );
            if($field['is_index']==1&&(!in_array($field['formtype'], $noindex))){
                $sql = 'ALTER TABLE  ' . $table . ' ADD INDEX (' . $field['name'] . ')';
                //echo $sql;exit;
                $this->exec($sql);
            }
        }
        return $msg;
    }

    public function parseSetting($field){
        if($field['setting']!=null){
            $setting=unserialize($field['setting']);
            //print_r($setting);
            foreach($setting as $key => $value){
                $field[$key]=$value;
            }
        }
        unset($field['setting']);
        return $field;
    }

    public function delete_field($fid)
    {
        if (is_array($fid)) {
            foreach ($fid as $id) {
                return $this->delete_field($id);
            }
        } else {
            $field = $this->where('fieldid', intval($fid))->leftJoin('model', 'model.modelid', 'model_field.modelid')->getOne(array('model.tablename as tablename', 'model_field.name as fieldname','model_field.is_system as is_system'));
            if($field['is_system']==1)
                return false;
            //print_r($field);
            $table = Config::database('table_pre') . 'module_' . $field['tablename'];
            $sql = 'ALTER TABLE ' . $table . ' DROP COLUMN ' . $field['fieldname'];
            if ($this->exec($sql)!==false) {
                return $this->where('fieldid', intval($fid))->delete();
            } else {
                return false;
            }
        }
        return true;
    }

    public function field_list($model_id){
        return $this->where('modelid',intval($model_id))->orderby('model_field.fieldid asc')->query();
    }

    /**
     * 表单字段检查,并处理违法的内容
     * @param $model_id
     * @param $form
     */
    public function field_check($model_id,$form){
        $fieldRes=$this->where('modelid',$model_id)->query();
        //var_dump($fieldRes);
        $nform=array();
        foreach($fieldRes as $field){
            //var_dump($form);exit;
            $field=$this->parseSetting($field);
            //验证字段是否存在
            if(!isset($form[$field['name']])){
                $var = array(
                    'error',
                    '没有'.$field['tname'],
                    '页面正在返回中，请稍后。。。'
                );
                redirect($_SERVER['HTTP_REFERER'], 2);
                controller('Admin', 'show_message', $var);
                exit;
            }
            //验证字段是否可为空
            if($field['is_null']==0){
                if(empty($form[$field['name']])){
                    $var = array(
                        'error',
                        $field['tname'].'是必填项',
                        '页面正在返回中，请稍后。。。'
                    );
                    redirect($_SERVER['HTTP_REFERER'], 2);
                    controller('Admin', 'show_message', $var);
                    exit;
                }
            }
            //验证正则判断
            if($field['pattern']!=null){
                if(!preg_match($field['pattern'],$form[$field['name']])){
                    $var = array(
                        'error',
                        !empty($field['errortips'])?$field['errortips']:$field['tname'].'验证失败',
                        '页面正在返回中，请稍后。。。'
                    );
                    redirect($_SERVER['HTTP_REFERER'], 2);
                    controller('Admin', 'show_message', $var);
                    exit;
                }
            }
            //最小长度判断
            if(isset($field['min_length'])){
                if(mb_strlen($form[$field['name']],'utf-8')<$field['min_length']){
                    $var = array(
                        'error',
                        '长度不可以少于'.$field['min_length'].'个字',
                        '页面正在返回中，请稍后。。。'
                    );
                    redirect($_SERVER['HTTP_REFERER'], 2);
                    controller('Admin', 'show_message', $var);
                    exit;
                }
            }
            if(isset($field['max_length'])){
                if(mb_strlen($form[$field['name']],'utf-8')>$field['max_length']){
                    $var = array(
                        'error',
                        '长度不可以多于'.$field['max_length'].'个字',
                        '页面正在返回中，请稍后。。。'
                    );
                    redirect($_SERVER['HTTP_REFERER'], 2);
                    controller('Admin', 'show_message', $var);
                    exit;
                }
            }
            if($field['formtype']=='pictures'){
                array_shift($form[$field['name']]);
                $nform[$field['name']] = serialize($form[$field['name']]);
            }elseif($field['formtype']=='tags') {
                $nform[$field['name']] = htmlspecialchars($form[$field['name']]);
            }elseif ($field['formtype']=='editor'){
                //$nform[$field['name']] = remove_xss($form[$field['name']]);
                $nform[$field['name']]  = $form[$field['name']];
            }elseif($field['formtype']=='areaSelect') {
                $nform[$field['name']] = implode(',',$form[$field['name']]);
            }else
            {
                $nform[$field['name']] = htmlspecialchars($form[$field['name']]);
            }
        }
        unset($form);
        return $nform;
    }
}