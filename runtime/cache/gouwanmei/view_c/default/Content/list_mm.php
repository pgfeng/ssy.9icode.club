<?php defined('APP_PATH') or exit('Sorry,Please from entry!'); ?>
<?php view("Content/head"); ?>
<?php $setting=CAT(30)?>
<?php $parent = CAT($pid)?>
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
		<div class="mm_right" style="min-height:470px;">
			<?php $data = CLBC($cid,4,$page,'roll')?>
			<?php if(is_array($data)) foreach($data AS $con) { ?>
			<div class="left mm">
				<a href="<?php echo $con['url']; ?>">
					<div class="imgs">
						<img src="<?php echo thumb($con['img'],365,220);?>" alt="<?php echo $con['title']; ?>">
					</div>
					<div class="radius"><?php echo $con['title']; ?></div>
					<div class="opacity"></div>
				</a>
			</div>
			<?php } ?>
			<div class="clear"></div>
		</div>
		<div id="pager">共<?php echo isset($resnum)?$resnum:$this->var['resnum'];?>条记录 <?php echo isset($pages)?$pages:$this->var['pages'];?> 第<?php echo isset($page)?$page:$this->var['page'];?>页/共<?php echo isset($allpages)?$allpages:$this->var['allpages'];?>页</div>
	</div>
	<div class="clear"></div>
</div>
<script>
	$(document).ready(function(){
		$('.mm_right>.mm').hover(function(){

			$(this).find('.opacity').stop().animate({'opacity': '0.5'}, 700);
			$(this).find('.radius').stop().animate({'top': '30'}, 300);
		},function(){

			$(this).find('.opacity').stop().animate({'opacity': '0'}, 700);
			$(this).find('.radius').stop().animate({'top': '-150'}, 300);
		});
	});
</script>
<?php view("Content/foot"); ?>