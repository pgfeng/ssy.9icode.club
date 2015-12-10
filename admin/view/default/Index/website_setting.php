<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title> GouWanMei 站点配置</title>
    <{template 'Index/head'}>
</head>
<body>
<div class="row" style="margin-top:30px;">
    <div class="nav" style="margin-left: 50px">
        <h1>站点设置</h1>
        <hr>
    </div>
    <div class="span24 offset1">
        <form id='J_Form' class="form-horizontal" action="<{URL('Index/website_setting')}>" method="post">
            <div class="row">
                <div class="control-group span24">
                    <label class="control-label">站点标题：</label>
                    <div class="controls">
                        <input type="text" name="title" class="control-text input-large" value="<{$title}>"
                               data-rules="{required:true,min:2,max:100}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="control-group span24">
                    <label class="control-label">关键字：</label>

                    <div class="controls">
                        <input type="text" name="keywords" class="control-text input-large" value="<{$keywords}>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="control-group span24">
                    <label class="control-label">描述：</label>

                    <div style="controls">
                        <textarea name="description" class="control-text input-large"
                                  style="height:90px;margin:10px;margin-top: 0px"><{$description}></textarea>
                    </div>
                </div>
            </div>
            <div style="clear: both;"></div>
            <div class="row">
                <div class="control-group span24">
                    <label class="control-label">静态缓存开关：</label>
                    <div class="controls">
                        <select name="view_cache" id="" value="<{php echo Config::cms('view_cache')}>" style="width:80px">
                            <option value="0">关闭</option>
                            <option value="1">开启</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="control-group span24">
                    <label class="control-label">静态缓存时间(秒)：</label>
                    <div class="controls">
                        <input type="number" name="view_cache_time" class="control-text" value="<{php echo config::cms('view_cache_time')}>" style="width:80px;">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="control-group span24">
                    <label class="control-label">模板目录：</label>

                    <div class="controls">
                        <input type="text" name="template" class="control-text" value="<{$template}>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-actions offset3">
                    <button type="submit" class="button button-primary">保存</button>
                    <button type="reset" class="button">重置</button>
                </div>
            </div>
        </form>
    </div>
    <script type="text/javascript">
        BUI.use('bui/form', function (Form) {

            new Form.Form({
                srcNode: '#J_Form'
            }).render();

        });

    </script>
</div>
</body>
</html>