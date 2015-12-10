<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');
/**
 * Created by PhpStorm.
 * User: pgf
 * Date: 15-8-25
 * Time: 下午2:54
 */
class model_fieldModel extends  Model{
    /**
     * @param $mid       模型ID
     * @param $content   内容
     * @return array     处理完成，返回数组
     */
    public function parse($mid,$content){
        if(empty($content))
            return array();
        $fieldRes = $this->where('modelid',$mid)->query();
        $ncontent = array();
        foreach($fieldRes as $field){
            if($field['formtype'] == 'pictures'){
                $content[$field['name']] = unserialize($content[$field['name']]);
            }elseif($field['formtype'] == 'areaSelect'){
                $area = explode(',',$content[$field['name']]);
                $level = 0;
                $content[$field['name']] = array();
                foreach($area as $id){
                    if($id!=null){
                        if($level==0){
                            $content[$field['name']]['province'] =array(
                                'id'   => $id,
                                'name' => province($id)
                            );
                        }elseif($level==1){
                            $content[$field['name']]['city'] =array(
                                'id'   => $id,
                                'name' => city($id)
                            );
                        }elseif($level==2){
                            $content[$field['name']]['district'] =array(
                                'id'   => $id,
                                'name' => district($id)
                            );
                        }
                    }
                    $level++;
                }
            }elseif($field['formtype'] == 'tags'){      //如果类型是tags则将此字段设置为数组
                $content[$field['name']] = explode(',',$content[$field['name']]);
            }
            //处理转义
            $ncontent[$field['name']] = $this->stripslashes($content[$field['name']]);
        }
        unset($content);
        return $ncontent;
    }
}