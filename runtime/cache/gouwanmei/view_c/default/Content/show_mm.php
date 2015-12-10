<?php defined('APP_PATH') or exit('Sorry,Please from entry!'); ?>
<?php view("Content/head"); ?>
<?php $setting = CAT(30)?>
<?php $pid = $category['pid']?>
<?php $parent = CAT($category['pid']);?>
<div class="wrap" style="margin-top:10px;background:#fff;padding:10px;">
	<div class="left page_left">
		<div class="quick1 gsjs" style="margin-bottom:0;">
			<div class="head" style="background:#c883c0;">
				<img src="<?php echo $this->var['view_vars']['img_path'];?>jmxx.png">
				<div class="title" style="color:#910782"><b style="color:#910782;">优惠信息</b>Quick Navigation</div>
			</div>
			<div class="con" style="background:#81b6db;color:#910782;">
				<div>加盟热线：</div>
				<div><?php echo $setting['jmrx']; ?></div>
				<div style="font-family: 微软雅黑;font-size: 8px;font-weight: 700;">QINGDAO PINDESHENGKE</div>
				<div style="font-family: 微软雅黑;font-size: 8px;font-weight: 700;">RESTAURANT MANAGEMENT</div>
			</div>
		</div>
		<div class="quick2 gsjs">
			<div class="head" style="background:#FFF000;">
				<img src="<?php echo $this->var['view_vars']['img_path'];?>ksdh1.png">
				<div class="title"><b><?php echo $parent['catname']; ?></b><?php echo $parent['enname']; ?></div>
			</div>
			<div class="con" style="background:#c6e08f;">
				<ul>
				<?php $cates = CATBC($pid)?>
				<?php if(is_array($cates)) foreach($cates AS $cat) { ?>
					<li><a href="<?php echo $cat['url']; ?>"><?php echo $cat['catname']; ?> <?php echo $cat['enname']; ?></a></li>
				<?php } ?>
				</ul>
			</div>
		</div>
	</div>
	<div class="right">
		<div class="mm_right_show" style="min-height:470px;">
			<div class="title"><?php echo isset($title)?$title:$this->var['title'];?></div>
			<div class="img" style="margin-top:30px;">
				<img src="<?php echo isset($img)?$img:$this->var['img'];?>" alt="<?php echo isset($title)?$title:$this->var['title'];?>" style="max-width:750px;">
			</div>
			<div class="description" style="margin-top:30px;background:#f4f4f4;padding:20px;color:#444;font-family:微软雅黑;"><?php echo isset($description)?$description:$this->var['description'];?></div>
		</div>
	</div>
	<div class="clear"></div>
</div>
<?php view("Content/foot"); ?>