<?php defined('APP_PATH') or exit('Sorry,Please from entry!'); ?>
<!DOCTYPE HTML>
<head>
    <title>附件管理</title>
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
        /*
        .row.form-actions.actions-bar{
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        */
    </style>
    <script>
        window.alert=BUI.Message.Alert;
        window.show=BUI.Message.Show;
    </script>
</head>
<body>
<div class="wrap">
    <div class="nav">
        <h1>附件管理</h1>
        <hr>
        筛选：<a class="button button-info button-small" href="<?php echo url('Content/attach/manage/image');?>"><i class='icon-white icon-picture'></i> 管理图片</a>
        <a class="button button-info button-small" href="<?php echo url('Content/attach/manage/file');?>"><i class='icon-white icon-file'></i> 管理文件</a>
        <a class="button button-info button-small" href="<?php echo url('Content/attach/manage/flash');?>"><i class='icon-white icon-facetime-video'></i> FLASH</a>
        <a class="button button-info button-small" href="<?php echo url('Content/attach/manage/media');?>"><i class='icon-white icon-film'></i> 媒体文件</a>
        <hr>
    </div>
    <div style="margin-bottom: 10px;">
        操作：
        <a href="javascript:;" class="button button-danger button-small" id="batchDelete"><i class="icon-white icon-trash"></i>  批量删除</a>&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="javascript:;" class="button button-primary button-small" id="choseAll"><i class="icon-white icon-ok"></i>  全选反选</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th width="50"><input type="checkbox" id="choseC"/></th>
                <th>文件名称</th>
                <th width="150">上传者</th>
                <th width="150">上传时间</th>
                <th width="150" style="text-align:center;">文件路径</th>
                <th width="50" style="text-align:center;">文件类型</th>
                <th width="140" style="text-align:center;">管理操作</th>
            </tr>
        </thead>
        <tbody>
        <?php if(is_array($attaches)) foreach($attaches AS $attach) { ?>
            <tr>
                <td>
                    <input type="checkbox" class="choseattach" attachid="<?php echo $attach['attachid'];?>" />
                </td>
                <td>
                    <a href="javascript:;" class="pics"><i class="<?php if($attach['attachtype']=='image') { ?>icon-picture<?php } elseif ($attach['attachtype']=='file') { ?>icon-file<?php } elseif ($attach['attachtype']=='flash') { ?>icon-facetime-video<?php } else { ?>icon-film<?php } ?>"></i> <?php echo $attach['attachname'];?></a>
                </td>
                <td>
                    ID:<?php echo $attach['userid'];?> 用户名:<?php echo $attach['username'];?>
                </td>
                <td>
                    <?php echo date("Y-m-d H:i:s", $attach['attachtime']);?>
                </td style="text-align:center;">
                <td>
                    <?php echo $attach['attachpath'];?>
                </td>
                <td style="text-align:center;">
                    <?php echo $attach['attachtype'];?>
                </td>
                <td style="text-align:center;">
                    <a href="javascript:;" attachid="<?php echo $attach['attachid'];?>" class="button button-danger del-attach">删除</a>
                    <a href="javascript:;" attachid="<?php echo $attach['attachid'];?>"  class="button button-inverse down-attach">下载</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <div style="text-align: center;"><?php echo isset($pager)?$pager:$this->var['pager'];?></div>
</div>
<script>
    $(document).ready(function(){
        //--全选按钮
        $('#choseAll,#choseC').click(function () {
            if($('.choseattach:checked').size()<$('.choseattach').size()) {
                $('.choseattach').each(function () {
                    $(this).prop('checked', true);
                });
                $('#choseC').prop('checked', true);
            }else{
                $('.choseattach').each(function () {
                    $(this).prop('checked', false);
                });
                $('#choseC').prop('checked', false);
            }
        });
        $('#batchDelete').click(function(){
            var id='';
            $('.choseattach:checked').each(function () {
                if(id==''){
                    id=$(this).attr('attachid');
                }else {
                    id += ',' + $(this).attr('attachid');
                }
            });
            show({
                msg : '确定要删除选中的附件么？删除后将无法使用！',
                icon : 'question',
                buttons : [
                    {
                        text:'删除',
                        elCls : 'button button-primary',
                        handler : function(){
                            $.post("<?php echo url('Content/attach/del');?>",{
                                'attacheid':id
                            },function(data){
                                var ht=data;
                                data = JSON.parse(data);
                                alert(data.msg,function(){
                                    if(data.status!='error'){
                                        window.location.reload();
                                    }
                                },data.status);
                            });
                        }
                    },
                    {
                        text:'取消',
                        elCls : 'button',
                        handler : function(){
                            this.close();
                        }
                    }
                ]
            });
        });
        $('.choseattach').click(function () {
            if($(this).prop('checked')==false){
                $('#choseC').prop('checked', false);
            }else{
                if($('.choseattach:checked ').size()==$('.choseattach').size()){
                    $('#choseC').prop('checked', true);
                }
            }
        });
        //--删除按钮
        $('.del-attach').click(function () {
            var obj = this;
            show({
                msg : '删除后将无法使用此附件，确定要删除么?',
                icon : 'question',
                buttons : [
                    {
                        text:'删除',
                        elCls : 'button button-primary',
                        handler : function(){
                            $.post("<?php echo url('Content/attach/del');?>",{
                                'attacheid':$(obj).attr('attachid')
                            },function(data){
                                var ht=data;
                                data = JSON.parse(data);
                                alert(data.msg,function(){
                                    if(data.status!='error'){
                                        window.location.reload();
                                    }
                                },data.status);
                            });
                            //this.close();
                        }
                    },
                    {
                        text:'取消',
                        elCls : 'button',
                        handler : function(){
                            this.close();
                        }
                    }
                ]
            });
        });
    });
</script>
</body>
</html>