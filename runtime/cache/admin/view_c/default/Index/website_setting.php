<?php defined('APP_PATH') or exit('Sorry,Please from entry!'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title> GouWanMei 站点配置</title>
    <?php view('Index/head'); ?>
</head>
<body>
<div class="row" style="margin-top:30px;">
    <div class="nav" style="margin-left: 50px">
        <h1>站点设置</h1>
        <hr>
    </div>
    <div class="span24 offset1">
        <form id='J_Form' class="form-horizontal" action="<?php echo URL('Index/website_setting');?>" method="post">
            <div class="row">
                <div class="control-group span24">
                    <label class="control-label">站点标题：</label>
                    <div class="controls">
                        <input type="text" name="title" class="control-text input-large" value="<?php echo isset($title)?$title:$this->var['title'];?>"
                               data-rules="{required:true,min:2,max:100}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="control-group span24">
                    <label class="control-label">关键字：</label>

                    <div class="controls">
                        <input type="text" name="keywords" class="control-text input-large" value="<?php echo isset($keywords)?$keywords:$this->var['keywords'];?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="control-group span24">
                    <label class="control-label">描述：</label>

                    <div style="controls">
                        <textarea name="description" class="control-text input-large"
                                  style="height:90px;margin:10px;margin-top: 0px"><?php echo isset($description)?$description:$this->var['description'];?></textarea>
                    </div>
                </div>
            </div>
            <div style="clear: both;"></div>
            <div class="row">
                <div class="control-group span24">
                    <label class="control-label">静态缓存开关：</label>
                    <div class="controls">
                        <select name="view_cache" id="" val="<?php echo Config::cms('view_cache')?>" style="width:80px">
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
                        <input type="number" name="view_cache_time" class="control-text" value="<?php echo config::cms('view_cache_time')?>" style="width:80px;">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="control-group span24">
                    <label class="control-label">模板目录：</label>

                    <div class="controls">
                        <input type="text" name="template" class="control-text" value="<?php echo isset($template)?$template:$this->var['template'];?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="control-group span24">
                    <label for="registercheckcode" class="control-label">用户注册验证码：</label>
                    <div class="controls">
                        <select name="registercheckcode" val="<?php echo isset($registercheckcode)?$registercheckcode:$this->var['registercheckcode'];?>" style="width:auto;">
                            <option value="0">关闭</option>
                            <option value="1">开启</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="control-group span24">
                    <label for="logincheckcode" class="control-label">用户登陆验证码：</label>
                    <div class="controls">
                        <select name="logincheckcode" val="<?php echo isset($logincheckcode)?$logincheckcode:$this->var['logincheckcode'];?>" style="width:auto;">
                            <option value="0">关闭</option>
                            <option value="1">开启</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="control-group span24">
                    <label for="membertokentype" class="control-label">用户效验：</label>
                    <div class="controls">
                        <select name="membertokentype" val="<?php echo isset($membertokentype)?$membertokentype:$this->var['membertokentype'];?>" style="width:100px;">
                            <option value="COOKIE">COOKIE</option>
                            <option value="SESSION">SESSION</option>
                        </select>
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