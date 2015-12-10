<!DOCTYPE HTML>
<html>
<head>
    <title> GouWanMei_数据模型字段管理</title>
    <{template 'Index/head'}>
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
            $('#formtype')[0].value='<{$field.formtype}>';
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
            <h1>模型管理--<{$module['name']}>模型字段管理</h1>
            <hr>
            <div>添加字段&nbsp;|&nbsp;<a href="<{url('Module/manage/field')}>?mid=<{$_GET['mid']}>">字段管理</a></div>
            <br>
        </div>
        <form method="post" action="<{if !isset($field)}><{url('Module/manage/field/add')}>?mid=<{$_GET.mid}><{else}><{url('Module/manage/field/edit')}>?mid=<{$_GET.mid}>&fid=<{$_GET.fid}><{/if}>" class="form-horizontal" id="field">
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
                                    <option value="file">文件</option>
<!--                                    <option value="files">多文件</option>-->
                                    <option value="date">日期</option>
                                    <option value="areaSelect">地区联动</option>
                                    <{if !($module['is_page']==0&&$module['is_category']==1)}>
                                        <option value="tags">标签小类</option>
                                    <{/if}>
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
                                <div class="controls"><input type="text" name="name" id="name" class="" data-rules="{required : true}"<{if isset($field['name'])}> value="<{$field['name']}>"<{/if}><{if isset($field)&&$field['is_system']==1}> readonly="true"<{/if}> placeholder="字段名称"/></div>
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
                                    <input type="text" class="" name="tname" id="tname" data-rules="{required : true}" placeholder="提示内容"<{if isset($field['tname'])}> value="<{$field['tname']}>"<{/if}>/>
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
                                    最小：<input name="min_length" class="input-small" data-rules="{number:true}" type="text"<{if isset($field['min_length'])}> value="<{$field['min_length']}>"<{/if}> placeholder="最小长度"/>
                                    最大：<input name="max_length" class="input-small" data-rules="{number:true}" type="text"<{if isset($field['max_length'])}> value="<{$field['max_length']}>"<{/if}> placeholder="最大长度">
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
                                    <input type="text" name="editor_height" class="" data-rules="{required : true}" value="<{if isset($field['editor_height'])}><{$field['editor_height']}><{else}>180px<{/if}>"/>
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
                                    <input type="text" name="editor_width" class="" data-rules="{required : true}" value="<{if isset($field['editor_width'])}><{$field['editor_width']}><{else}>100%<{/if}>"/>
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
                                    <input type="text" name="textarea_height" class="" data-rules="{required : true}" value="<{if isset($field['textarea_height'])}><{$field['textarea_height']}><{else}>100px<{/if}>"/>
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
                                    <input type="text" name="textarea_width" class="" data-rules="{required : true}" value="<{if isset($field['textarea_width'])}><{$field['textarea_width']}><{else}>150px<{/if}>"/>
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
                                    <input type="text" name="tags_width" class="" data-rules="{required : true}" value="<{if isset($field['textarea_width'])}><{$field['tags_width']}><{else}>500px<{/if}>"/>
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
                                    <input type="text" name="tags_height" class="" data-rules="{required : true}" value="<{if isset($field['tags_height'])}><{$field['tags_height']}><{else}>120px<{/if}>"/>
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
                                    <input type="text" name="input_height" class="" data-rules="{required : true}" value="<{if isset($field['input_height'])}><{$field['input_height']}><{else}>18px<{/if}>"/>
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
                                    <input type="text" name="input_width" class="" data-rules="{required : true}" value="<{if isset($field['input_width'])}><{$field['input_width']}><{else}>180px<{/if}>"/>
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
                                    <input type="text" name="input_value" class="input-large" placeholder="默认内容"<{if isset($field['input_value'])}> value="<{$field['input_value']}>"<{/if}>/>
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
                                    <input type="text" name="p_allow_type" class="input-large" value="<{if isset($field['p_allow_type'])}><{$field['p_allow_type']}><{else}>gif|jpg|jpeg|png|bmp<{/if}>"/>
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
                                    <input type="text" name="placeholder" class="input-large" value="<{if isset($field['placeholder'])}><{$field['placeholder']}><{/if}>" placeholder="请输入placeholder"/>
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
                                    <input type="text" name="f_allow_type" class="input-large" placeholder="填写允许上传文件的后缀，如果多种以|隔开" value="<{if isset($field['f_allow_type'])}><{$field['f_allow_type']}><{else}>zip|rar|tar|gz<{/if}>"/>
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
                                    <input type="text" class="" name="regexp" id="regexpIpt" placeholder="请输入正则"<{if isset($field['pattern'])}> value="<{$field['pattern']}>"<{/if}>/>
                                    <input type="text" class="" name="errortip" id="regexpTipIpt" placeholder="正则验证失败提醒"<{if isset($field['errortips'])}> value="<{$field['errortips']}>"<{/if}>/>
                                    <select id="regexp">
                                        <option value="">选择常用判断</option>
                                        <{loop $regexp $exp}>
                                        <option value='{"regexp":"<{model()->addslashes($exp['regexp'])}>","tips":"<{$exp['tip']}>"}'><{$exp['name']}></option>
                                        <{/loop}>
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
                                <select name="areaSelectLevel" class="controls bui-form-group-select bui-form-field-select bui-form-field" value="<{if isset($field['areaSelectLevel'])}><{$field['areaSelectLevel']}><{else}>zip|rar|tar|gz<{/if}>">
                                    <option value="1">省份</option>
                                    <option value="2">城市</option>
                                    <option value="3">县区</option>
                                </select>
                            </div>
                        </td>
                    </tr>
<!--                    <tr class="date">-->
<!--                        <td>-->
<!--                            <label class="control-label" title="留空则不限制时间">日期范围：</label>-->
<!--                        </td>-->
<!--                        <td>-->
<!--                            <div class="controls control-group">-->
<!--                                <div class="controls">-->
<!--                                    <input name="start" class="input-small calendar" type="text"><label>&nbsp;-&nbsp;</label><input name="end" class="input-small calendar" type="text">-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </td>-->
<!--                    </tr>-->
                    <tr>
                        <td>
                            <label class="control-label">是否可为空：</label>
                        </td>
                        <td>
                            <div class="controls control-group">
                                <div class="controls bui-form-field-radiolist" data-items="{'1':'是','2' : '否'}">
                                    <{php if(isset($field['is_null']))$field['is_null']=$field['is_null']==1?1:2; }>
                                    <input name="is_null" type="hidden" value="<{if isset($field['is_null'])}><{$field['is_null']}><{else}>1<{/if}>">
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
                                <{php if(isset($field['is_index']))$field['is_index']=$field['is_index']==1?1:2; }>
                                <div class="controls bui-form-field-radiolist" data-items="{'1':'是','2' : '否'}">
                                    <input name="is_index" type="hidden" value="<{if isset($field['is_index'])}><{$field['is_index']}><{else}>1<{/if}>">
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row form-actions actions-bar">
                <div class="span13 offset6 ">
                    <input type="submit" class="button button-primary" value="<{if isset($field)}>修改字段<{else}>添加字段<{/if}>" id="submit"/>
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