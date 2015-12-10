{template "Content/head"}
<div class="wrap">
    <div class="ucenter">
        {template "Member/left_bar"}
        <div class="right">
            <div class="top">修改资料</div>
            <div class="content">
                <div class="edit_profileform">
                    <form action="{get_url()}" method="post">
                        <div class="input_t">
                            <label class="lle">昵称：</label>
                            <input type="text" placeholder="请输入昵称" name="nickername" value="{$user['nickername']}" class="input">
                        </div>
                        <div class="input_t">
                            <label class="lle">性别：</label>
                            <label for=""><input type="radio" name="sex" value="0"{if $user['sex']==0} checked{/if}>女</label>
                            <label for=""><input type="radio" name="sex" value="1"{if $user['sex']==1} checked{/if}>男</label>
                        </div>
                        <div class="input_t">
                            <label class="lle">邮箱：</label>
                            <input type="text" placeholder="请输入邮箱" value="{$user['email']}" class="input">
                        </div>
                        <div class="input_t">
                            <label class="lle">QQ：</label>
                            <input type="text" name="qq" placeholder="请输入QQ" value="{$user['qq']}" class="input">
                        </div>
                        <div class="input_t">
                            <label class="lle">手机号：</label>
                            <input type="text" name="mobile" placeholder="请输入手机号" value="{$user['mobile']}" class="input">
                        </div>
                        <div class="input_t">
                            <label class="lle">生日：</label>
                            <input type="date" name="birthday" placeholder="输入生日有惊喜" value="{$user['birthday']}" class="input">
                        </div>
                        <div class="input_t">
                            <input type="submit" name="edit_profile" value="修改" class="submit">
                            <input type="reset" value="重置" class="reset">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
{template "Content/foot"}