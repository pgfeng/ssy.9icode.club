<?php defined('APP_PATH') or exit('Sorry,Please from entry!'); ?>
<?php view("Content/head"); ?>
<?php $setting = CAT(30)?>
<?php $pid=22?>
<?php $parent = CAT($pid);?>
<div class="wrap" style="margin-top:10px;background:#fff;padding:10px;">
	<div class="left page_left">
		<div class="quick1 gsjs">
			<div class="head">
				<img src="<?php echo $this->var['view_vars']['img_path'];?>jmxx.png">
				<div class="title"><b>优惠信息</b>Quick Navigation</div>
			</div>
			<div class="con">
				<div>加盟热线：</div>
				<div><?php echo $setting['jmrx']; ?></div>
								<div style="font-family: 微软雅黑;font-size: 8px;font-weight: 700;">QINGDAO PINDESHENGKE</div>
				<div style="font-family: 微软雅黑;font-size: 8px;font-weight: 700;">RESTAURANT MANAGEMENT</div>
			</div>
		</div>
		<div class="quick2 gsjs">
			<div class="head">
				<img src="<?php echo $this->var['view_vars']['img_path'];?>ksdh.png">
				<div class="title"><b><?php echo $parent['catname']; ?></b><?php echo $parent['enname']; ?></div>
			</div>
			<div class="con">
				<ul>
				<?php $cates = CATBC($pid)?>
				<?php if(is_array($cates)) foreach($cates AS $cat) { ?>
					<li><a href="<?php echo $cat['url']; ?>"><?php echo $cat['catname']; ?> <?php echo $cat['enname']; ?></a></li>
				<?php } ?>
				</ul>
			</div>
		</div>
	</div>
	<div class="right new_right">
		<div class="top"><b><?php echo $category['catname']; ?></b><?php echo $category['enname']; ?></div>
		<div class="new_content">
			<div class="top">
				<div class="title"><?php echo isset($title)?$title:$this->var['title'];?></div>
				<div class="smt">发表时间:<?php echo date("Y-m-d H:i:s",$inputtime);?></div>
			</div>
			<div class="content" style="min-height:400px;"><?php echo isset($content)?$content:$this->var['content'];?></div>
			<div class="bottom">
				<?php if($previous) { ?>
					<div class="left">上一篇：<a href="<?php echo $previous['url']; ?>" style="color:#4292c9;"><?php echo $previous['title']; ?></a></div>
				<?php } ?>
				<?php if($next) { ?>
					<div class="right">下一篇：<a href="<?php echo $next['url']; ?>" style="color:#4292c9;"><?php echo $next['title']; ?></a></div>
				<?php } ?>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>
<?php view("Content/foot"); ?>