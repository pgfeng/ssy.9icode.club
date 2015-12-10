{template "Content/head"}
{if $loginstatus!=0}
{if $loginstatus==1}
<div>
    对不起，您的账号密码不匹配！
</div>
{elseif $loginstatus==2}
<div>
    对不起，验证码不正确！
</div>
{/if}
<div class="wrap">
    <div class="login">
        <form action="{get_url()}" id="loginform" method="post">
            <input type="text" name="username">
            <input type="password" name="password">
            <input type="text" name="checkcode"><img src="{URL('Use/checkcode')}" alt="">
            <input type="submit" value="登陆">
        </form>
    </div>
</div>
{else}
    登陆成功了！！！
{/if}
{template "Content/foot"}