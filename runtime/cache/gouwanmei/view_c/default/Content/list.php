<?php defined('APP_PATH') or exit('Sorry,Please from entry!'); ?>
<?php view("Content/head"); ?>
<?php $setting = CAT(30)?>
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
		<div class="top"><b><?php echo isset($catname)?$catname:$this->var['catname'];?></b><?php echo isset($enname)?$enname:$this->var['enname'];?></div>
		<div class="new_list">
			<?php $data = CLBC($cid,24,$page,'roll')?>
			<ul>
				<?php if(is_array($data)) foreach($data AS $con) { ?>
				<li><a href="<?php echo $con['url']; ?>">
					<div class="left"><?php echo $con['title']; ?></div>
					<div class="right"><?php echo date("Y-m-d",$con['inputtime']);?></div>
					<div class="clear"></div>
				</a></li>
				<?php } ?>
			</ul>
			<div id="pager">共<?php echo isset($resnum)?$resnum:$this->var['resnum'];?>条记录 <?php echo isset($pages)?$pages:$this->var['pages'];?> 第<?php echo isset($page)?$page:$this->var['page'];?>页/共<?php echo isset($allpages)?$allpages:$this->var['allpages'];?>页</div>
		</div>
	</div>
	<div class="clear"></div>
</div>
<?php view("Content/foot"); ?>