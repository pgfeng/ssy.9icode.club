<?php defined('APP_PATH') or exit('Sorry,Please from entry!'); ?>
<!DOCTYPE HTML>
<html>
<head>
    <title> GouWanMei_数据模型字段管理</title>
    <?php view('Index/head'); ?>
    <style>
        .wrap {
            margin:30px;
        }
        #field table tr{
            border-bottom: 1px solid #e5e5e5;

        }
        #field{
            width: 100%;
        }
        #field table tr td{
            line-height: 20px;
            margin-bottom: 10px;;
        }
        #field tr:hover{
            background: #e5e5e5;
        }
        #field table tr td:nth-of-type(1){
            float: right;
            width:50%;
        }

        .form-horizontal .controls{
            height:30px;
        }
    </style>
</head>
<body>
    <script>
        $(document).ready(function () {
            $('tr[class]').css('display','none');
            $('#formtype').change(function () {
                var type=this.value,
                    oTr=$('tr[class]');
                oTr.css('display','none');
                for(var i=0;i<oTr.length;i++){
                    if($(oTr[i]).hasClass(type)){
                        $(oTr[i]).css('display','');
                    }
                }
            });
            <?php if($method=='edit'){ ?>
            $('#formtype')[0].value='<?php echo $field['formtype']; ?>';
            var type=$('#formtype')[0].value,
                oTr=$('tr[class]');
            oTr.css('display','none');
            for(var i=0;i<oTr.length;i++){
                if($(oTr[i]).hasClass(type)){
                    $(oTr[i]).css('display','');
                }
            }
            <?php } ?>

        });
    </script>
    <div>
    </div>
    <div class="wrap">
        <div class="nav">
            <h1>模型管理--<?php echo $module['name'];?>模型字段管理</h1>
            <hr>
            <div>添加字段&nbsp;|&nbsp;<a href="<?php echo url('Module/manage/field');?>?mid=<?php echo $_GET['mid'];?>">字段管理</a></div>
            <br>
        </div>
        <form method="post" action="<?php if(!isset($field)) { ?><?php echo url('Module/manage/field/add');?>?mid=<?php echo $_GET['mid']; ?><?php } else { ?><?php echo url('Module/manage/field/edit');?>?mid=<?php echo $_GET['mid']; ?>&fid=<?php echo $_GET['fid']; ?><?php } ?>" class="form-horizontal" id="field">
            <table id="field" class="control-group">
                <tbody>
                    <tr>
                        <td>
                            <label class="control-label"><s>*</s>字段类型：</label>
                        </td>
                        <td>
                            <div class="controls bui-form-group">
                                <select class="controls bui-form-group-select" id="formtype" name="formtype" data-rules="{required : true}">
                                    <option value="">请选择字段类型</option>
                                    <option value="title">标题</option>
                                    <option value="text">单行文本</option>
                                    <option value="textarea">多行文本</option>
                                    <option value="editor">编辑器</option>
                                    <option value="picture">图片</option>
                                    <option value="pictures">多图片</option>
                                    <option value="file">文件</option>                                    <option value="date">日期</option>
                                    <option value="areaSelect">地区联动</option>
                                    <?php if(!($module['is_page']==0&&$module['is_category']==1)) { ?>
                                        <option value="tags">标签小类</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="control-label"><s>*</s>字段名：</label>
                        </td>
                        <td>
                            <div class="controls bui-form-group">
                                <div class="controls"><input type="text" name="name" id="name" class="" data-rules="{required : true}"<?php if(isset($field['name'])) { ?> value="<?php echo $field['name'];?>"<?php } ?><?php if(isset($field)&&$field['is_system']==1) { ?> readonly="true"<?php } ?> placeholder="字段名称"/></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="control-label"><s>*</s>字段别名：</label>
                        </td>
                        <td>
                            <div class="controls bui-form-group">
                                <div class="controls control-group">
                                    <input type="text" class="" name="tname" id="tname" data-rules="{required : true}" placeholder="提示内容"<?php if(isset($field['tname'])) { ?> value="<?php echo $field['tname'];?>"<?php } ?>/>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="title text textarea">
                        <td>
                            <label class="control-label"><s></s>长度范围：</label>
                        </td>
                        <td>
                            <div class="controls bui-form-group">
                                <div class="controls control-group">
                                    最小：<input name="min_length" class="input-small" data-rules="{number:true}" type="text"<?php if(isset($field['min_length'])) { ?> value="<?php echo $field['min_length'];?>"<?php } ?> placeholder="最小长度"/>
                                    最大：<input name="max_length" class="input-small" data-rules="{number:true}" type="text"<?php if(isset($field['max_length'])) { ?> value="<?php echo $field['max_length'];?>"<?php } ?> placeholder="最大长度">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="editor">
                        <td>
                            <label class="control-label"><s></s>编辑器高度：</label>
                        </td>
                        <td>
                            <div class="controls bui-form-group">
                                <div class="controls control-group">
                                    <input type="text" name="editor_height" class="" data-rules="{required : true}" value="<?php if(isset($field['editor_height'])) { ?><?php echo $field['editor_height'];?><?php } else { ?>180px<?php } ?>"/>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="editor">
                        <td>
                            <label class="control-label" title="请根据网站内容页面宽度设定"><s></s>编辑器宽度：</label>
                        </td>
                        <td>
                            <div class="controls bui-form-group">
                                <div class="controls control-group">
                                    <input type="text" name="editor_width" class="" data-rules="{required : true}" value="<?php if(isset($field['editor_width'])) { ?><?php echo $field['editor_width'];?><?php } else { ?>100%<?php } ?>"/>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="textarea">
                        <td>
                            <label class="control-label"><s></s>文本域高度：</label>
                        </td>
                        <td>
                            <div class="controls bui-form-group">
                                <div class="controls control-group">
                                    <input type="text" name="textarea_height" class="" data-rules="{required : true}" value="<?php if(isset($field['textarea_height'])) { ?><?php echo $field['textarea_height'];?><?php } else { ?>100px<?php } ?>"/>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="textarea">
                        <td>
                            <label class="control-label"><s></s>文本域宽度：</label>
                        </td>
                        <td>
                            <div class="controls bui-form-group">
                                <div class="controls control-group">
                                    <input type="text" name="textarea_width" class="" data-rules="{required : true}" value="<?php if(isset($field['textarea_width'])) { ?><?php echo $field['textarea_width'];?><?php } else { ?>150px<?php } ?>"/>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="tags">
                        <td>
                            <label class="control-label"><s></s>标签框宽度：</label>
                        </td>
                        <td>
                            <div class="controls bui-form-group">
                                <div class="controls control-group">
                                    <input type="text" name="tags_width" class="" data-rules="{required : true}" value="<?php if(isset($field['textarea_width'])) { ?><?php echo $field['tags_width'];?><?php } else { ?>500px<?php } ?>"/>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="tags">
                        <td>
                            <label class="control-label"><s></s>标签框高度：</label>
                        </td>
                        <td>
                            <div class="controls bui-form-group">
                                <div class="controls control-group">
                                    <input type="text" name="tags_height" class="" data-rules="{required : true}" value="<?php if(isset($field['tags_height'])) { ?><?php echo $field['tags_height'];?><?php } else { ?>120px<?php } ?>"/>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="text">
                        <td>
                            <label class="control-label"><s></s>文本框高度：</label>
                        </td>
                        <td>
                            <div class="controls bui-form-group">
                                <div class="controls control-group">
                                    <input type="text" name="input_height" class="" data-rules="{required : true}" value="<?php if(isset($field['input_height'])) { ?><?php echo $field['input_height'];?><?php } else { ?>18px<?php } ?>"/>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="text">
                        <td>
                            <label class="control-label"><s></s>文本框宽度：</label>
                        </td>
                        <td>
                            <div class="controls bui-form-group">
                                <div class="controls control-group">
                                    <input type="text" name="input_width" class="" data-rules="{required : true}" value="<?php if(isset($field['input_width'])) { ?><?php echo $field['input_width'];?><?php } else { ?>180px<?php } ?>"/>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="text textarea editor">
                        <td>
                            <label class="control-label">内容默认值：</label>
                        </td>
                        <td>
                            <div class="controls bui-form-group">
                                <div class="controls control-group">
                                    <input type="text" name="input_value" class="input-large" placeholder="默认内容"<?php if(isset($field['input_value'])) { ?> value="<?php echo $field['input_value'];?>"<?php } ?>/>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="picture pictures">
                        <td>
                            <label class="control-label">允许上传的图片类型：</label>
                        </td>
                        <td>
                            <div class="controls bui-form-group">
                                <div class="controls control-group">
                                    <input type="text" name="p_allow_type" class="input-large" value="<?php if(isset($field['p_allow_type'])) { ?><?php echo $field['p_allow_type'];?><?php } else { ?>gif|jpg|jpeg|png|bmp<?php } ?>"/>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="text textarea">
                        <td>
                            <label class="control-label">placeholder：</label>
                        </td>
                        <td>
                            <div class="controls bui-form-group">
                                <div class="controls control-group">
                                    <input type="text" name="placeholder" class="input-large" value="<?php if(isset($field['placeholder'])) { ?><?php echo $field['placeholder'];?><?php } ?>" placeholder="请输入placeholder"/>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="file files">
                        <td>
                            <label class="control-label">允许上传的文件类型：</label>
                        </td>
                        <td>
                            <div class="controls bui-form-group">
                                <div class="controls control-group">
                                    <input type="text" name="f_allow_type" class="input-large" placeholder="填写允许上传文件的后缀，如果多种以|隔开" value="<?php if(isset($field['f_allow_type'])) { ?><?php echo $field['f_allow_type'];?><?php } else { ?>zip|rar|tar|gz<?php } ?>"/>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="text title textarea">
                        <td>
                            <label class="control-label">正则判断：</label>
                        </td>
                        <td>
                            <div class="controls bui-form-group">
                                <div class="controls">
                                    <input type="text" class="" name="regexp" id="regexpIpt" placeholder="请输入正则"<?php if(isset($field['pattern'])) { ?> value="<?php echo $field['pattern'];?>"<?php } ?>/>
                                    <input type="text" class="" name="errortip" id="regexpTipIpt" placeholder="正则验证失败提醒"<?php if(isset($field['errortips'])) { ?> value="<?php echo $field['errortips'];?>"<?php } ?>/>
                                    <select id="regexp">
                                        <option value="">选择常用判断</option>
                                        <?php if(is_array($regexp)) foreach($regexp AS $exp) { ?>
                                        <option value='{"regexp":"<?php echo model()->addslashes($exp['regexp']);?>","tips":"<?php echo $exp['tip'];?>"}'><?php echo $exp['name'];?></option>
                                        <?php } ?>
                                    </select>
                                <div>
                            </div>
                        </td>
                    </tr>
                    <tr class="areaSelect">
                        <td>
                            <label class="control-label" title="选择地区级别">选择地区级别：</label>
                        </td>
                        <td>
                            <div class="controls">
                                <select name="areaSelectLevel" class="controls bui-form-group-select bui-form-field-select bui-form-field" value="<?php if(isset($field['areaSelectLevel'])) { ?><?php echo $field['areaSelectLevel'];?><?php } else { ?>zip|rar|tar|gz<?php } ?>">
                                    <option value="1">省份</option>
                                    <option value="2">城市</option>
                                    <option value="3">县区</option>
                                </select>
                            </div>
                        </td>
                    </tr><!--                        <td>--><!--                        </td>--><!--                            <div class="controls control-group">--><!--                                    <input name="start" class="input-small calendar" type="text"><label>&nbsp;-&nbsp;</label><input name="end" class="input-small calendar" type="text">--><!--                            </div>--><!--                    </tr>-->
                    <tr>
                        <td>
                            <label class="control-label">是否可为空：</label>
                        </td>
                        <td>
                            <div class="controls control-group">
                                <div class="controls bui-form-field-radiolist" data-items="{'1':'是','2' : '否'}">
                                    <?php if(isset($field['is_null']))$field['is_null']=$field['is_null']==1?1:2; ?>
                                    <input name="is_null" type="hidden" value="<?php if(isset($field['is_null'])) { ?><?php echo $field['is_null'];?><?php } else { ?>1<?php } ?>">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="control-label">是否为搜索条件：</label>
                        </td>
                        <td>
                            <div class="controls control-group">
                                <?php if(isset($field['is_index']))$field['is_index']=$field['is_index']==1?1:2; ?>
                                <div class="controls bui-form-field-radiolist" data-items="{'1':'是','2' : '否'}">
                                    <input name="is_index" type="hidden" value="<?php if(isset($field['is_index'])) { ?><?php echo $field['is_index'];?><?php } else { ?>1<?php } ?>">
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row form-actions actions-bar">
                <div class="span13 offset6 ">
                    <input type="submit" class="button button-primary" value="<?php if(isset($field)) { ?>修改字段<?php } else { ?>添加字段<?php } ?>" id="submit"/>
                    <button type="reset" class="button offset1">重新设置</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        $(window).ready(function(){
            var oSexp=$('#regexp'),
                oIptregexpIpt=$('#regexpIpt'),
                oregexpTipIpt=$('#regexpTipIpt');
            oSexp.change(function(){
                if(this.value!='') {
                    var expjson = JSON.parse(this.value);
                    oIptregexpIpt[0].value = expjson.regexp;
                    oregexpTipIpt[0].value = (expjson.tips);
                }else{

                    oIptregexpIpt[0].value = '';
                    oregexpTipIpt[0].value = '';
                }
            });
        });
        BUI.use('bui/form',function(Form){
            new Form.Form({
                srcNode : '#field'
            }).render();
        });
    </script>
</body>
</html>