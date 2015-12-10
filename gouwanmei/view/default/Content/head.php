<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{$SEO.title}</title>
    <meta name="keywords" content="{$SEO.keywords}">
    <meta name="description" content="{$SEO['description']}">
	{includeStyle "ssy.css"}
	{includeScript "jquery.js,ssy.js"}
</head>
<body>
{php $setting = CAT(30)}
<div class="header">
	<div class="con">
		<div class="left logo">
			<img src="{IMG_PATH}logo.png" alt="">
		</div>
		<div class="left jmrx">
			<div class="jm">加盟热线：</div>
			<div class="number">{$setting['jmrx']}</div>
		</div>
		<div class="right">
			<img src="{IMG_PATH}topright.png" alt="加盟电话">
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="nav">
	<div class="nav_con">
		<ul class="nav_ul">
			<li><span><a href="/">首页</a></span></li>
			{php $cates = CATBC(0,7);}
			{loop $cates $cat}
			<li>
				<div class="line"></div>
				<a href="{$cat[url]}">{$cat[catname]}</a>
				{php $ccates = CATBC($cat['cid']);}
				{if count($ccates)>0}
				<ul class="chil_ul">
					{loop $ccates $cat}
					<li><a href="{$cat.url}">{$cat.catname}</a></li>
					{/loop}
				</ul>
				{/if}
			</li>
			{/loop}
			<li>
				<div class="line"></div>
				<a href="{URL('Member')}">用户中心</a>
				<ul class="chil_ul">
					<li><a href="{URL('Member/login')}">登陆</a></li>
					<li><a href="{URL('Member/register')}">注册</a></li>
					<li><a href="{URL('Member/logout')}">退出</a></li>
				</ul>
			</li>
		</ul>
	</div>
</div>
<div id="banner">
	<img src="{$setting.banner}">
</div>