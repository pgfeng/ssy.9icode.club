<?php defined('APP_PATH') or exit('Sorry,Please from entry!'); ?>
<?php view("Content/head"); ?>
<div class="wrap">
    <div class="ucenter">
        <div class="left">
            <div>
                <div class="top">我的信息</div>
                <ul>
                    <li><a href="">我的资料</a></li>
                    <li><a href="">我的资产</a></li>
                    <li><a href="">修改资料</a></li>
                </ul>
            </div>
            <div>
                <div class="top">账户信息</div>
                <ul>
                    <li><a href="">修改密码</a></li>
                    <li><a href="">账户余额</a></li>
                    <li><a href="">退出登录</a></li>
                </ul>
            </div>
            <div>
                <div class="top">我的订单</div>
                <ul>
                    <li><a href="">全部订单</a></li>
                    <li><a href="">未付款</a></li>
                    <li><a href="">未发货</a></li>
                    <li><a href="">已完成</a></li>
                </ul>
            </div>
        </div>
        <div class="right">

        </div>
        <div class="clear"></div>
    </div>
</div>
<?php view("Content/foot"); ?>