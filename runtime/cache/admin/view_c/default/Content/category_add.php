<?php defined('APP_PATH') or exit('Sorry,Please from entry!'); ?>
<!DOCTYPE HTML>
<html>
<head>
    <title> GouWanMei_添加栏目</title>
    <?php view('Index/head'); ?>
    <style>
        .wrap {
            margin:30px;
        }
        table tr{
            border-bottom: 1px solid #e5e5e5;
        }
        table{
            width: 100%;
        }
        table tr td{
            line-height: 20px;
            margin-bottom: 10px;;
        }
        tr:hover{
            background: #e5e5e5;
        }
        table tr td:nth-of-type(1){
            float: left;
            width:50%;
        }
        .form-horizontal .controls{
            height:25px;
            margin-left: 0;
        }
    </style>

    <script>
        window.alert=BUI.Message.Alert;
    </script>
</head>
<body>
<div class="wrap">
    <?php if(isset($mid)) { ?>
    <div class="nav">
        <h1><?php echo $model['name'];?>--<?php if($action=='add') { ?>添加<?php } else { ?>修改<?php } ?><?php if($model['is_page']) { ?>单网页<?php } else { ?>栏目<?php } ?></h1>
        <hr>
    </div>
        <?php $type=$model['is_page']?'page':'category';?>
        <form action="<?php echo url('Content/'.$type.'/'.$action);?>" class="form-horizontal bui-form bui-form-field-container" id="form" method="post">
            <?php module('form')->fieldtoform($field,$type,$parent,$cid,$action);?>
            <?php if($action=='edit') { ?>
            <input type="hidden" value="<?php echo isset($cid)?$cid:$this->var['cid'];?>" name="cid"/>
            <?php } ?>
            <input type="hidden" value="<?php echo isset($cmid)?$cmid:0;?>" name="cmid"/>
            <input type="hidden" value="<?php echo isset($mid)?$mid:$this->var['mid'];?>" name="mid"/>
            <div class="row form-actions actions-bar">
                <div class="span13 offset6 ">
                    <input type="submit" class="button button-primary bui-form-field" name="<?php echo isset($action)?$action:$this->var['action'];?>_category" value="<?php if($action=='add') { ?>添加<?php } else { ?>修改<?php } ?><?php if($model['is_page']==1) { ?>单网页<?php } else { ?>栏目<?php } ?>" id="submit" aria-disabled="false" aria-pressed="false">
                    <button type="reset" class="button offset1">重新设置</button>
                </div>
            </div>
        </form>
        <script>
            $('#form').ready(function(){
                var reheight=$('textarea,input,select');
                for(var i=0;i<reheight.size();i++){
                    $(reheight[i]).parents(2).height($(reheight[i]).height()+8);
                }
            });
        </script>
    </div>
    <?php } else { ?>
    <div class="content">
        <div id="content" class="hidden">
            <form id="form" class="form-horizontal bui-form bui-form-field-container">
                <div class="row" style="">
                    <div class="control-group span8">
                        <label class="control-label"><s>*</s>选择栏目模型：</label>
                        <div class="controls">
                            <select name="mid" id="" class="controls bui-form-group-select" data-rules="{required : true}">
                                <?php if(is_array($model)) foreach($model AS $m) { ?>
                                <option value="<?php echo $m['modelid'];?>" ispage="<?php echo $m['is_page'];?>">
                                    <?php echo $m['name'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="control-group span8" id="conModel">
                        <label class="control-label"><s>*</s>选择内容模型：</label>
                        <div class="controls bui-form-group bui-form-field-container">
                            <select name="cmid" id="" class="controls bui-form-group-select" data-rules="{required : true}">
                                <option value>选择内容模型</option>
                                <?php if(is_array($cmodel)) foreach($cmodel AS $m) { ?>
                                <option value="<?php echo $m['modelid'];?>">
                                    <?php echo $m['name'];?></option>
                                <?php } ?>
                            </select>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        BUI.use(['bui/overlay','bui/form'],function(Overlay,Form){
            new Form.Form({
                srcNode : '#form'
            }).render();
            var dialog = new Overlay.Dialog({
                title:'请选择模型',
                width:500,
                //配置DOM容器的编号
                contentId:'content',
                buttons:[
                    {
                        text:'选择模型',
                        elCls : 'button-large button-primary',
                        handler : function(){
                            $('#form').submit();
                        }
                    }],
                success:function () {
                    alert('确认');
                    this.close();
                },
                cancel:function(){
                    alert('必须要选择模型哦！');
                    return false;
                }
            });
            dialog.show();
            $('#btnShow').on('click',function () {
                dialog.show();
            });
        });
    </script>
    <?php } ?>
    <script>
        BUI.use(['bui/overlay','bui/form'],function(Overlay,Form){
            new Form.Form({
                srcNode : '#form'
            }).render();
        });

    </script>
    <script>
        $('#form').ready(function(){
            var reheight=$('input');
            for(var i=0;i<reheight.size();i++){
                $(reheight[i]).parents(2).height($(reheight[i]).height()+8);
            }

            var reheight=$('textarea');
            for(var i=0;i<reheight.size();i++){
                $(reheight[i]).parents(2).height($(reheight[i]).height()+16);
            }
            $('ul.piclist').ready(function(){
                var piclist = $('ul.piclist');
                for (var i = 0; i < piclist.length; i++) {
                    var liN = $(piclist[i]).find('li').size();
                    $(piclist[i]).height(liN*30)
                }
            });
        });
    </script>
</div>
</body>
</html>