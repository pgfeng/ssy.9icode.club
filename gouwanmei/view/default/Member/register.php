{template "Content/head"}
{$registerstatus}
<div class="wrap">
    <form action="{get_url()}" method="post">
        <input type="text" name="username" placeholder="账号"><br>
        <input type="text" name="nickername" placeholder="昵称"><br>
        <input type="email" name="email" placeholder="邮箱"><br>
        <input type="password" name="password" placeholder="密码"><br>
        <input type="password" name="password_again" placeholder="重复密码"><br>
        <!-- 是否需要验证码 -->
        {if $website['registercheckcode']==1}
            <input type="text" name="checkcode"><img src="{url('Use/checkcode')}" alt="">
        {/if}
        <input type="submit" value="注册">
    </form>
</div>
{template "Content/foot"}