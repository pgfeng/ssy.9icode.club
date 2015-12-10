<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');
/**
 * Created by PhpStorm.
 * 表单渲染模型,针对内容管理系统，版权所有，请勿盗用。
 * User: PGF
 * Date: 15-6-15
 * Time: 上午 9:03
 */

class formModule
{
    private $content=array();
    private $have_editor_script = false;                        //是否已经引入编辑器脚本
    private $have_upload_script = false;                        //是否已经引入上传脚本
    private $have_pics_script   = false;                        //是否引入多图片上传脚本
    private $have_area_script   = false;                        //是否已经引入地区联动脚本

    /**
     * 渲染表单主函数
     * @param $field            字段
     * @param $type             类型
     * @param int $parent       父级  //对内容无用
     * @param int $catid        栏目ID
     * @param string $action    行为
     * @param bool $id          内容的ID
     */
    public function fieldToForm($field, $type, $parent = 0, $catid = 0, $action = 'add', $id = false){
        $field=model()->stripslashes($field);
        if($action=='edit'){
            if($type=='category' || $type=='page'){
                $category = model('category')->where('cid',$catid)->getOne('catetable,catid');
                $cid = $catid;
                $catid = $category['catid'];    //转存cid
                $catetable = $category['catetable'];
                $content = model('category')->leftJoin($catetable,$catetable.'.id','category.catid')->where(Config::database('table_pre').'category.catid',$catid)->where(Config::database('table_pre').'category.cid',$cid)->getOne();
                $this->content = model()->stripslashes($content);
                unset($content);
            }elseif($type=='content'){
                $category = model('category')->where('cid',$catid)->getOne('contable,catid,show_view');
                //var_dump($category);
                $contable = $category['contable'];
                $content = model($contable)->where('id',$id)->getOne();
                if(empty($content))
                    $content['show_view'] = $category['show_view'];
                $this->content = model()->stripslashes($content);
                $this->content['show_view']=$this->content['template'];unset($this->content['template']);
            }
        }
        //var_dump($field);
        $form='<table class="control-group"><tbody>';
        if($type=='category' || $type=='page'){
            $form.=$this->select_category($parent);
        }
        foreach($field as $ff)
        {
            $ff=model('model_field')->parseSetting($ff);
            if($ff['formtype']=='text'){
                $form.=$this->text($ff);
            }elseif($ff['formtype']=='textarea'){
                $form.=$this->textarea($ff);
            }elseif($ff['formtype']=='title'){
                $form.=$this->text($ff);
            }elseif($ff['formtype']=='editor'){
                $form.=$this->editor($ff);
            }elseif($ff['formtype']=='picture'){
                $form.=$this->picture($ff);
            }elseif($ff['formtype']=='pictures'){
                $form.=$this->pictures($ff);
            }elseif($ff['formtype']=='file'){
                $form.=$this->file($ff);
            }elseif($ff['formtype']=='files'){
                $form.=$this->files($ff);
            }elseif($ff['formtype']=='date'){
                $form.=$this->date($ff);
            }elseif($ff['formtype']=='areaSelect'){
                $form.=$this->areaSelect($ff);
            }else{
                echo $ff['formtype'].'不存在！';
            }
        }
        $form.=$this->template($type,$catid);
        echo $form.='</table>';
    }

    private function etemplate($type,$value=false){
        $tr='';
        $tr.='<tr title="在content目录下以'.$type.'开头的模板">';
        $tr.='<td>';
        $tr.='<label class="control-label"><s>*</s>';
        if($type=='category')
            $tr.='栏目首页模板';
        if($type=='list')
            $tr.='列表页模板';
        if($type=='show')
            $tr.='内容页模板';
        if($type=='page')
            $tr.='单网页模板';
        $tr.='：</label>';
        $tr.='</td><td>';
        $tr.='<div class="controls bui-form-group bui-form-field-container" aria-disabled="false" aria-pressed="false">';
        $tr.='<select name="';
        if($type=='category')
            $tr.='category_view';
        if($type=='list')
            $tr.='list_view';
        if($type=='show')
            $tr.='show_view';
        if($type=='page')
            $tr.='page_view';
        $tr.=$value?'" value="'.$value.'"':'';
        $tr.='" class="controls bui-form-group-select bui-form-field-select bui-form-field" style="width:auto;" data-rules="{required : true}" aria-disabled="false" aria-pressed="false">';
        $list=module('admin')->getViewList('Content',$type);
        foreach($list as $path){
            $tr.='<option value="'.$path.'">'.$path.'</option>';
        }
        $tr.='</select>';
        $tr.='</div>';
        $tr.='</td>';
        $tr.='</tr>';
        return $tr;
    }
    private function template($type,$catid){
        $choseTemp='';
        if($type=='category'){
            $view=isset($this->content['category_view'])?$this->content['category_view']:false;
            $choseTemp.=$this->etemplate('category',$view);
            $view=isset($this->content['list_view'])?$this->content['list_view']:false;
            $choseTemp.=$this->etemplate('list',$view);
            $view=isset($this->content['show_view'])?$this->content['show_view']:false;
            $choseTemp.=$this->etemplate('show',$view);
            unset($view);
        }elseif($type=='page'){
            $view=isset($this->content['show_view'])?$this->content['show_view']:false;
            $choseTemp.=$this->etemplate('page',$view);
            unset($view);
        }elseif($type=='content'){
            //var_dump($this->content);
            if(empty($this->content)){
                $category = model('category')->where('cid',$catid)->getOne('show_view');
                $view = $category['show_view'];
            }
            else
                $view=isset($this->content['show_view'])?$this->content['show_view']:false;
            //$view=is_null(var)
            $choseTemp.=$this->etemplate('show',$view);
            unset($view);
        }
        return $choseTemp;
    }
    private function text($field){
        $ff='<tr><td>';
        $ff.='<label class="control-label">';
        if($field['is_null']==0)
            $ff.='<s>*</s>';
        $ff.=$field['tname'];
        $ff.='：</label>';
        $ff.='</td><td>';
        $placeholder=isset($field['placeholder'])?$field['placeholder']:'';
        $placeholder=' placeholder="'.$placeholder.'"';
        $input_value=isset($field['input_value'])?$field['input_value']:'';
        $input_value=isset($this->content[$field['name']])?$this->content[$field['name']]:$input_value;
        $datarules='';
        if($field['is_null']==0)
            $datarules="{required:true";
        if(isset($field['min_length']))
            $datarules.=empty($datarules)?'{minlength:'.$field['min_length']:',minlength:'.$field['min_length'];
        if(isset($field['max_length']))
            $datarules.=empty($datarules)?'{maxlength:'.$field['max_length']:',maxlength:'.$field['max_length'];
        $datarules.="}";
        $style='style="';
        if(isset($field['input_width'])&&$field['input_width']!='')
            $style.='width:'.$field['input_width'].';';
        if(isset($field['input_height'])&&$field['input_height']!='')
            $style.='height:'.$field['input_height'].';';
        $style.='"';
        $ff.='<div class="controls bui-form-group bui-form-field-container" aria-disabled="false" aria-pressed="false">
                <div class="controls control-group">
                    <input type="text" class="bui-form-field" name="'.$field['name'].'" id="tname" data-rules= "'.$datarules.'" value="'.$input_value.'" aria-disabled="false" aria-pressed="false"'.$placeholder.' '.$style.'>
                </div>
             </div>';
        $ff.='</td></tr>';
        return $ff;
    }
    private function textarea($field)
    {
        //var_dump($field);
        $ff='<tr><td>';
        $ff.='<label class="control-label">';
        if($field['is_null']==0)
            $ff.='<s>*</s>';
        $ff.=$field['tname'];
        $ff.='：</label>';
        $ff.='</td><td>';
        $datarules=$field['is_null']==0?'{required : true}':'';
        $placeholder=isset($field['placeholder'])?$field['placeholder']:'';
        $placeholder=' placeholder="'.$placeholder.'"';
        $input_value=isset($field['input_value'])?$field['input_value']:'';
        $input_value=isset($this->content[$field['name']])?$this->content[$field['name']]:$input_value;
        $datarules='';
        if($field['is_null']==0)
            $datarules="{required:true";
        if(isset($field['min_length']))
            $datarules.=empty($datarules)?'{minlength:'.$field['min_length']:',minlength:'.$field['min_length'];
        if(isset($field['max_length']))
            $datarules.=empty($datarules)?'{maxlength:'.$field['max_length']:',maxlength:'.$field['max_length'];
        $datarules.="}";
        $style='style="resize: none;';
        if(isset($field['textarea_width'])&&$field['textarea_width']!='')
            $style.='width:'.$field['textarea_width'].';';
        if(isset($field['textarea_height'])&&$field['textarea_height']!='')
            $style.='height:'.$field['textarea_height'].';';
        $style.='"';
        $ff.='<div class="controls bui-form-group bui-form-field-container" aria-disabled="false" aria-pressed="false">
                <div class="controls control-group">
                    <textarea type="text" class="bui-form-field" name="'.$field['name'].'" id="tname" '.$style.' data-rules="'.$datarules.'" '.$placeholder.' value="'.$input_value.'" aria-disabled="false" aria-pressed="false"></textarea>
                </div>
             </div>';
        $ff.='</td></tr>';
        return $ff;
    }
    private function title($field)
    {
        return $this->text($field);
    }
    private function editor($field)
    {
        $editor='<tr><td/>';
        $editor.='<label class="control-label">';
        if($field['is_null']==0)
            $editor.='<s>*</s>';
        $editor.=$field['tname'];
        $editor.='：</label>';
        $editor.='</td><td>';
        $editor.=$this->includeEdiorScript();
        $style='';
        $datarules=$field['is_null']==0?'{required : true}':'';
        if(isset($field['editor_height']))
            $style.='height:'.$field['editor_height'].';';
        if(isset($field['editor_width']))
            $style.='width:'.$field['editor_width'].';';
        $style.='margin-left:170px;';
        $editor.='<textarea  id="'.$field['name'].'" data-rules="'.$datarules.'" style="'.$style.'" name="'.$field['name'].'">';
        $input_value='';
        $input_value=isset($this->content[$field['name']])?$this->content[$field['name']]:$input_value;
        $editor.=$input_value;
        $editor.='</textarea>';
        $editor.='<script>;
			var editor;
			KindEditor.ready(function(K) {
				editor = K.create("textarea[name=\''.$field['name'].'\']", {
					allowFileManager : true,
                    pasteType : 2,
					themeType:"simple",
					//autoHeightMode : true,
					filterMode : false,
					wellFormatMode: true,
                    uploadJson: "'.Router::$router->url('Content/upload',array('fieldid'=>$field['fieldid'])).'",
					afterCreate : function() {
						this.loadPlugin("autoheight");
					}
				});
				editor.html();
				});
                </script>';
        return $editor.='</td></tr>';
    }
    private function includeEdiorScript(){
        if(!$this->have_editor_script){
            $this->have_editor_script=true;
            return '<link rel="stylesheet" href="'.Config::template('public_path').'kindeditor/themes/default/default.css"><script type="text/javascript" src="'.Config::template('public_path').'kindeditor/kindeditor.js"></script><script type="text/javascript" src="'.Config::template('public_path').'kindeditor/lang/zh_CN.js"></script>';
        }else{
            return '';
        }
    }
    private function picture($field)
    {
        $picture='<tr>';
        $picture.=$this->includeEdiorScript();
        $picture.='<td>';
        $picture.='<label class="control-label">';
        if($field['is_null']==0)
            $picture.='<s>*</s>';
        $picture.=$field['tname'];
        $picture.='：</label>';
        $picture.='</td><td>';
        $value = isset($this->content[$field['name']])?$this->content[$field['name']]:'';
        $datarules=$field['is_null']==0?'{required : true}':'';
        $picture.='<script>
			KindEditor.ready(function(K) {
                var editor = K.editor({
					allowFileManager : true,
                    uploadJson: "'.Router::$router->url('Content/upload',array('fieldid'=>$field['fieldid'])).'",
				});
				K("#btn'.$field['name'].'").click(function() {
					editor.loadPlugin("image", function() {
                        editor.plugin.imageDialog({
							imageUrl : K("#'.$field['name'].'").val(),
							clickFn : function(url, title, width, height, border, align) {
                            K("#'.$field['name'].'").val(url);
                            editor.hideDialog();
                        }
						});
					});
				});
			});
			</script>';
        $picture.='<p><input type="text" id="'.$field['name'].'" value="'.$value.'" data-rules="'.$datarules.'" name="'.$field['name'].'" style="width:280px;height:22px;"/> <input type="button" class="button" id="btn'.$field['name'].'" value="选择图片" /></p>';
        return $picture.='</td></tr>';
        //return '';
    }
    private function includePicsScript(){
        if($this->have_pics_script==0){
            $this->have_pics_script=1;
            return '<script type="text/javascript" src="'.Config::template('public_path').'kindeditor/pics.js"></script>';
        }
    }
    private function pictures($field)
    {
        $picture='<tr>';
        $picture.=$this->includeEdiorScript();
        $picture.=$this->includePicsScript();
        $picture.='<td>';
        $picture.='<label class="control-label">';
        $picture.=$field['tname'];
        $picture.='：</label>';
        $picture.='</td><td>';
        $picture.='<script>
			KindEditor.ready(function(K) {
                var editor = K.editor({
					allowFileManager : true,
                    uploadJson: "'.Router::$router->url('Content/upload',array('fieldid'=>$field['fieldid'])).'",
				});
				K("#btn'.$field['name'].',#'.$field['name'].'").click(function() {
					editor.loadPlugin("image", function() {
                        editor.plugin.imageDialog({
							imageUrl : K("#'.$field['name'].'").val(),
							clickFn : function(url, title, width, height, border, align) {
                            K("#'.$field['name'].'").val(url);
                            editor.hideDialog();
                            pics("#'.$field['name'].'");
                        }
						});
					});
				});
			});
			</script>';
        $picture.='<p class="pics"><input type="text" id="'.$field['name'].'" value="" name="'.$field['name'].'[]" style="width:280px;height:22px;" readonly="true"/> <input type="button" class="button" id="btn'.$field['name'].'" value="选择图片" /><ul class="piclist">';
        $picture.= $this->parsePics($field);
        $picture.='</ul></p>';
        $picture.='</td></tr>';
        return $picture;
    }

    private function parsePics($field){
        $li='';
        if(isset($this->content[$field['name']]))
        if($this->content[$field['name']]!=null){
            $this->content[$field['name']] = unserialize($this->content[$field['name']]);
            foreach($this->content[$field['name']] as $picture){
                $li.='<li><input type="text" value="'.$picture.'" name="'.$field['name'].'[]" style="width:280px;height:22px;" readonly="true" class="pics" aria-disabled="false"> <a class="button bui-form-field" href="javascript:;" onclick="viewPic(this)">预览</a> <a class="button bui-form-field" href="javascript:;" onclick="delPic(this)">删除</a></li>';
            }
        }
        return $li;
    }
    private function file($field)
    {
        $file = '<tr><td>';
        $file.= '<label class="control-label">';
        if($field['is_null']==0)
            $file.='<s>*</s>';
        $file.= $field['tname'];
        $file.= ':</label>';
        $file.='</td><td>';
        $file.= $this->includeEdiorScript();
        $value = isset($this->content[$field['name']])?$this->content[$field['name']]:'';
        $file.='<script>
			KindEditor.ready(function(K) {
				var editor = K.editor({
					allowFileManager : true,
                    uploadJson: "'.Router::$router->url('Content/upload',array('fieldid'=>$field['fieldid'])).'",
				});
				K("#file_'.$field['name'].',#file_'.$field['name'].'_url").click(function() {
					editor.loadPlugin("insertfile", function() {
                        editor.plugin.fileDialog({
							fileUrl : K("#file_'.$field['name'].'").val(),
							clickFn : function(url, title) {
                            K("#file_'.$field['name'].'_url").val(url);
                            editor.hideDialog();
                        }
						});
					});
				});
        });
        </script> ';
        $file.='<p><input type="text" id="file_'.$field['name'].'_url" name="'.$field['name'].'" value="'.$value.'" style="width:280px;height:22px;" readonly="true"/> <input type="button" class="button" id="file_'.$field['name'].'" value="选择文件" /></p>';
        $file.='</td></tr>';
        return $file;
    }
    private function areaSelect($field){
        $areaSelect = '<tr><td>';
        $areaSelect.= '<label class="control-label">';
        if($field['is_null']==0)
            $areaSelect.='<s>*</s>';
        $areaSelect.= $field['tname'];
        $areaSelect.= ':</label>';
        $areaSelect.='</td><td>';
        $areaSelect.=$this->includeAreaScript();
        $value = isset($this->content[$field['name']])?$this->content[$field['name']]:'';
        $areaSelect.='<div class="controls bui-form-group bui-form-field-container" aria-disabled="false" aria-pressed="false">
                <div class="controls control-group" id="areaSelect'.$field['name'].'" name="'.$field['name'].'">
                </div>
             </div>';
        $areaSelect.='<script>
                //alert("'.$value.'");
                $("#areaSelect'.$field['name'].'").areaSelect('.$field['areaSelectLevel'].',"input-small bui-form-field-select bui-form-field","'.$value.'");
            </script>';
        $areaSelect.='</td></tr>';
        return $areaSelect;
    }
    private function date($field)
    {
        $date = '<tr><td><label class="control-label">';
        if($field['is_null']==0)
            $date.='<s>*</s>';
        $date .=$field['tname'];
        $date .= '：</label>';
        $date .='</td><td>';
        $date .='<div class="bui-form-group controls" data-rules="{dateRange : true}">
                    <input name="'.$field['name'].'" type="text" class="calendar" style="width:150px"/>
                </div>';
        $date .='</td></tr>';
        return $date;
        //echo 'date';
    }

    /**
     * 调出
     * @return string
     */
    private function includeAreaScript(){
        if($this->have_area_script===false){
            $this->have_area_script = true;
            return '<script>
        (function($) {
            $.fn.areaSelect = function(level,style,value) {
                //value = "";
                //alert(value);
                value = value.split(",");
                //alert(value[1])
                var id = $(this).attr("id");
                var procince = {};
                function foropt(data,level){
                level = level||0;
                    var opt = "";
                    if(level==0){
                        opt = "<option>省区</option>";
                    }else if(level==1){
                        opt = "<option>城市</option>";
                    }else if(level==2){
                        opt = "<option>县区</option>";
                    }
                    for(var i = 0; i<data.length; i++){
                        if(level==0){
                            opt+="<option value=\'"+data[i].pid+"\'>"+data[i].name+"</option>";
                        }else if(level==1||level==2){
                            opt+="<option value=\'"+data[i].cid+"\'>"+data[i].name+"</option>";
                        }
                    }
                    return opt;
                }
                if(level=="1"){
                    $(this).append("<select class=\'"+style+" procince\' index=\'"+value[0]+"\' value=\'"+value[0]+"\' id=\'"+$("#"+id).attr(\'name\')+"procince\' name=\'"+$("#"+id).attr(\'name\')+"[]\' style=\'width:auto;\'><option value=\'0\'>省份</option></select>");
                    $.get("'.Router::$router->url('Use/area/1').'",function(data){
                        var procince = JSON.parse(data);
                        $("#"+id).find("select.procince").html(foropt(procince));
                    });
                }else if(level==\'2\'){
                    $(this).append("<select class=\'"+style+" procince\' index=\'"+value[0]+"\' value=\'"+value[0]+"\' id=\'"+$("#"+id).attr(\'name\')+"procince\' name=\'"+$("#"+id).attr(\'name\')+"[]\' style=\'width:auto;\'><option value=\'0\'>省份</option></select>");
                    $.get("'.Router::$router->url('Use/area/1').'",function(data){
                        var procince = JSON.parse(data);
                        $("#"+id).find("select.procince").html(foropt(procince));
                    });
                    $("#"+id).append("&nbsp;&nbsp;<select class=\'"+style+" city\' index=\'"+value[1]+"\' value=\'"+value[1]+"\' name=\'"+$("#"+id).attr(\'name\')+"[]\' style=\'width:auto;\'><option value=\'0\'>城市</option></select>");
                    if($("#"+id).find("select.city").attr("index")!=undefined){
                        $.ajax({ url: "'.Router::$router->url('Use/area/2').'?pid="+$("#"+id).find("select.procince").attr("index"),dataType: "json", success: function(data){
                            $("#"+id).find("select.city").html(foropt(data,1));
                            $("#"+id).find("select.city").find("option[value="+$("#"+id).find("select.city").attr("index")+"]").attr("selected","true");
                            $("#"+id).find("select.district").css("display","none");
                        }});
                    }
                    $(this).find("select.procince").change(function(){
                        $.ajax({ url: "'.Router::$router->url('Use/area/2').'?pid="+$(this).val(),dataType: "json", success: function(data){
                            $("#"+id).find("select.city").html(foropt(data,1));
                            $("#"+id).find("select.district").css("display","none");
                        }});
                    });
                }else if(level==\'3\'){
                    $(this).append("<select class=\'"+style+" procince\' index=\'"+value[0]+"\' value=\'"+value[0]+"\' id=\'"+$("#"+id).attr(\'name\')+"procince\' name=\'"+$("#"+id).attr(\'name\')+"[]\' style=\'width:auto;\'><option value=\'0\'>省份</option></select>");
                    $.get("'.Router::$router->url('Use/area/1').'",function(data){
                        var procince = JSON.parse(data);
                        $("#"+id).find("select.procince").html(foropt(procince));
                    });
                    $("#"+id).append("&nbsp;&nbsp;<select class=\'"+style+" city\' index=\'"+value[1]+"\' value=\'"+value[1]+"\' name=\'"+$("#"+id).attr(\'name\')+"[]\' style=\'width:auto;\'><option value=\'0\'>城市</option></select>");
                    if($("#"+id).find("select.city").attr("index")!=undefined){
                        $.ajax({ url: "'.Router::$router->url('Use/area/2').'?pid="+$("#"+id).find("select.procince").attr("index"),dataType: "json", success: function(data){
                            $("#"+id).find("select.city").html(foropt(data,1));
                            $("#"+id).find("select.city").find("option[value="+$("#"+id).find("select.city").attr("index")+"]").attr("selected","true");
                            $("#"+id).find("select.district").css("display","none");
                        }});
                    }
                    $(this).find("select.procince").change(function(){
                        $.ajax({ url: "'.Router::$router->url('Use/area/2').'?pid="+$(this).val(),dataType: "json", success: function(data){
                            $("#"+id).find("select.city").html(foropt(data,1));
                            $("#"+id).find("select.district").css("display","none");
                        }});
                    });
                    $("#"+id).append("&nbsp;&nbsp;<select class=\'"+style+" district\' index=\'"+value[2]+"\' value=\'"+value[2]+"\' name=\'"+$("#"+id).attr(\'name\')+"[]\' style=\'width:auto;\'><option value=\'0\'>县区</option></select>");
                    if($("#"+id).find("select.district").attr("index")!=undefined){
                        $.ajax({ url: "'.Router::$router->url('Use/area/3').'?pid="+$("#"+id).find("select.city").attr("index"),dataType: "json", success: function(data){
                                if(data.length>0){
                                    $("#"+id).find("select.district").html(foropt(data,2));
                                    $("#"+id).find("select.district").find("option[value="+$("#"+id).find("select.district").attr("index")+"]").attr("selected","true");
                                    $("#"+id).find("select.district").css("display","inline-block");
                                }else{
                                    $("#"+id).find("select.district").remove();
                                }
                            }});
                    }
                    $(this).find("select.city").change(function(){
                        $.ajax({ url: "'.Router::$router->url('Use/area/3').'?pid="+$(this).val(),dataType: "json", success: function(data){
                        //alert(data.length);
                            if(data.length>0){
                            if($("#"+id).find("select.district").size()==0){
                    $("#"+id).append("&nbsp;&nbsp;<select class=\'"+style+" district\' index=\'"+value[2]+"\' value=\'"+value[2]+"\' name=\'"+$("#"+id).attr(\'name\')+"[]\' style=\'width:auto;\'><option value=\'0\'>县区</option></select>");

                            }
                                $("#"+id).find("select.district").html(foropt(data,1));
                                $("#"+id).find("select.district").css("display","inline-block");
                            }else{
                                $("#"+id).find("select.district").remove();
                            }
                        }});
                    });

                        //alert($("#"+id).find("select.procince").attr("value"));
                    //$(this).append("&nbsp;&nbsp;<select class=\'"+style+" district\' name=\'"+$(this).attr(\'name\')+"\'><option value=\'0\'>县区</option></select>");
                }
            };
        })(jQuery);
            </script>';
            //return '<script type="text/javascript" src="'.Config::template('public_path').'js/areaSelect.js"></script>';
        }else{
            return '';
        }
    }

    /**
     * 选取上级栏目
     * @param $catid
     * @return string
     */
    private function select_category($catid){
        //echo $catid
        $select='<tr><td><label class="control-label"><s>*</s>选择上级栏目：</label></td><td>';
        $select.='<div class="controls bui-form-group bui-form-field-container" aria-disabled="false" aria-pressed="false"><select name="parent" value="'.$catid.'" class="controls bui-form-group-select bui-form-field-select bui-form-field" style="width:auto;" data-rules="{required : true}" aria-disabled="false" aria-pressed="false">';
        $select.='<option value="0">作为顶级栏目</option>';
        $select.=module('category')->select_category_option1();
        $select.='</select></div>';
        //--解决不自动选择
        $select.='<script>
            $("select[name=parent]").find("option[value='.$catid.']").attr("selected","selected");
        </script>';
        $select.='</td></tr>';
        return $select;

    }
}