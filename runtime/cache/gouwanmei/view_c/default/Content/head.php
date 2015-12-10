<?php defined('APP_PATH') or exit('Sorry,Please from entry!'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $SEO['title']; ?></title>
    <meta name="keywords" content="<?php echo $SEO['keywords']; ?>">
    <meta name="description" content="<?php echo $SEO['description'];?>">
	<link href="/gouwanmei/public/css/ssy.css" type="text/css" rel="stylesheet">
	<script type="text/javascript" src="/gouwanmei/public/js/jquery.js"></script><script type="text/javascript" src="/gouwanmei/public/js/ssy.js"></script>
</head>
<body>
<?php $setting = CAT(30)?>
<div class="header">
	<div class="con">
		<div class="left logo">
			<img src="<?php echo $this->var['view_vars']['img_path'];?>logo.png" alt="">
		</div>
		<div class="left jmrx">
			<div class="jm">加盟热线：</div>
			<div class="number"><?php echo $setting['jmrx'];?></div>
		</div>
		<div class="right">
			<img src="<?php echo $this->var['view_vars']['img_path'];?>topright.png" alt="加盟电话">
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="nav">
	<div class="nav_con">
		<ul class="nav_ul">
			<li><span><a href="/">首页</a></span></li>
			<?php $cates = CATBC(0,7);?>
			<?php if(is_array($cates)) foreach($cates AS $cat) { ?>
			<li>
				<div class="line"></div>
				<a href="<?php echo $cat['url'];?>"><?php echo $cat['catname'];?></a>
				<?php $ccates = CATBC($cat['cid']);?>
				<?php if(count($ccates)>0) { ?>
				<ul class="chil_ul">
					<?php if(is_array($ccates)) foreach($ccates AS $cat) { ?>
					<li><a href="<?php echo $cat['url']; ?>"><?php echo $cat['catname']; ?></a></li>
					<?php } ?>
				</ul>
				<?php } ?>
			</li>
			<?php } ?>
			<li>
				<div class="line"></div>
				<a href="<?php echo URL('Member');?>">用户中心</a>
				<ul class="chil_ul">
					<li><a href="<?php echo URL('Member/login');?>">登陆</a></li>
					<li><a href="<?php echo URL('Member/register');?>">注册</a></li>
					<li><a href="<?php echo URL('Member/logout');?>">退出</a></li>
				</ul>
			</li>
		</ul>
	</div>
</div>
<div id="banner">
	<img src="<?php echo $setting['banner']; ?>">
</div>