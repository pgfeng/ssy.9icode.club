<?php defined('APP_PATH') or exit('Sorry,Please from entry!'); ?>
<?php view("Content/head"); ?>
<?php $setting = CAT(30)?>
<div class="wrap">
	<div class="home_show">
		<div class="quick1">
			<div class="head" style="border-bottom: 2px solid #f9d18f;padding-bottom:10px;"><img src="<?php echo $this->var['view_vars']['img_path'];?>ksdh.png" alt=""><b>快速导航 </b> Quick Navgation</div>
			<div class="con">
				<ul class="dhlist">
					<li><a href="<?php $cat = Module('content')->category(14); if(!empty($cat)){ ?><?php echo $cat['url'];?><?php } unset($cat); ?>"><?php $cat = Module('content')->category(14); if(!empty($cat)){ ?><?php echo $cat['catname'];?><?php } unset($cat); ?> <?php $cat = Module('content')->category(14); if(!empty($cat)){ ?><?php echo $cat['enname'];?><?php } unset($cat); ?></a></li>
					<li><a href="<?php $cat = Module('content')->category(15); if(!empty($cat)){ ?><?php echo $cat['url'];?><?php } unset($cat); ?>"><?php $cat = Module('content')->category(15); if(!empty($cat)){ ?><?php echo $cat['catname'];?><?php } unset($cat); ?> <?php $cat = Module('content')->category(15); if(!empty($cat)){ ?><?php echo $cat['enname'];?><?php } unset($cat); ?></a></li>
					<li><a href="<?php $cat = Module('content')->category(5); if(!empty($cat)){ ?><?php echo $cat['url'];?><?php } unset($cat); ?>"><?php $cat = Module('content')->category(5); if(!empty($cat)){ ?><?php echo $cat['catname'];?><?php } unset($cat); ?> <?php $cat = Module('content')->category(5); if(!empty($cat)){ ?><?php echo $cat['enname'];?><?php } unset($cat); ?></a></li>
					<li><a href="<?php $cat = Module('content')->category(26); if(!empty($cat)){ ?><?php echo $cat['url'];?><?php } unset($cat); ?>"><?php $cat = Module('content')->category(26); if(!empty($cat)){ ?><?php echo $cat['catname'];?><?php } unset($cat); ?> <?php $cat = Module('content')->category(26); if(!empty($cat)){ ?><?php echo $cat['enname'];?><?php } unset($cat); ?></a></li>
					<li><a href="<?php $cat = Module('content')->category(2); if(!empty($cat)){ ?><?php echo $cat['url'];?><?php } unset($cat); ?>"><?php $cat = Module('content')->category(2); if(!empty($cat)){ ?><?php echo $cat['catname'];?><?php } unset($cat); ?> <?php $cat = Module('content')->category(2); if(!empty($cat)){ ?><?php echo $cat['enname'];?><?php } unset($cat); ?></a></li>
					<li><a href="<?php $cat = Module('content')->category(24); if(!empty($cat)){ ?><?php echo $cat['url'];?><?php } unset($cat); ?>"><?php $cat = Module('content')->category(24); if(!empty($cat)){ ?><?php echo $cat['catname'];?><?php } unset($cat); ?> <?php $cat = Module('content')->category(24); if(!empty($cat)){ ?><?php echo $cat['enname'];?><?php } unset($cat); ?></a></li>
					<div class="clear"></div>
				</ul>
			</div>
			<div class="clear"></div>
		</div>
		<div class="quick2">
			<div class="head" style="border-bottom: 2px solid #af4aa4;padding-bottom:6px;"><img src="<?php echo $this->var['view_vars']['img_path'];?>qydt.png" alt=""><b><a href="<?php $cat = Module('content')->category(22); if(!empty($cat)){ ?><?php echo $cat['url'];?><?php } unset($cat); ?>">企业动态</a> </b> Quick Navgation</div>
			<?php $contents = CLBC(31,9)?>
			<div class="con">
				<?php if(is_array($contents)) foreach($contents AS $con) { ?>
					<ul>
						<li>
							<a href="<?php echo $con['url']; ?>" style="display:block;width:100%;"><div class="left"><?php echo str_cut($con['title'],15);?></div><div class="right"><?php echo date("Y-m-d",$con['inputtime']);?></div><div class="clear"></div></a>
						</li>
					</ul>
				<?php } ?>
			</div>
		</div>
		<div class="quick3" style="">
		<div class="head" style="border-bottom: 2px solid #af4aa4;padding-bottom:6px;"><img src="<?php echo $this->var['view_vars']['img_path'];?>qydt.png" alt=""><b>宣传视频 </b> Quick Navgation</div>
			<video width="300" controls="controls" style="margin-top: 84px;">  
        		<source src="<?php echo $setting['video']; ?>" type="video/mp4" ></source>  
        		您的浏览器不支持video标签  
    		</video>
		</div>
		<div class="quick4">
			<div class="head" style="border-bottom: 2px solid #a7d053;padding-bottom:8px;padding-top:5px;"><img src="<?php echo $this->var['view_vars']['img_path'];?>stdm.png" alt=""><b><a href="<?php $cat = Module('content')->category(29); if(!empty($cat)){ ?><?php echo $cat['url'];?><?php } unset($cat); ?>">店面展示</a> </b> Quick Navgation</div>
			<div class="con">
				<?php $data = CLBM(85,2)?>
				<?php if(is_array($data)) foreach($data AS $con) { ?>
					<div class="left" style="margin-left:12px;">
						<a href="<?php echo $con['url']; ?>"><img src="<?php echo thumb($con['img'],130,130);?>" alt="<?php echo $con['title']; ?>"></a>
					</div>
				<?php } ?>
				<div class="clear"></div>
			</div>
		</div>
		<div class="quick5">
			<div class="head" style="border-bottom: 2px solid #ed589c;padding-bottom:6px;"><img src="<?php echo $this->var['view_vars']['img_path'];?>jmxx.png" alt=""><b><a href="<?php $cat = Module('content')->category(23); if(!empty($cat)){ ?><?php echo $cat['url'];?><?php } unset($cat); ?>">加盟信息</a> </b> Quick Navgation</div>
			<div class="con">
				<ul>
					<?php $data = CLBC(23,4)?>
					<?php if(is_array($data)) foreach($data AS $con) { ?>
					<li><a href="<?php echo $con['url']; ?>" style="display:block;width:100%;"><div class="left"><?php echo str_cut($con['title'],13);?></div><div class="right"><?php echo date("Y-m-d",$con['inputtime']);?></div><div class="clear"></div></a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<div class="quick6">
			<div class="head"><img src="<?php echo $this->var['view_vars']['img_path'];?>jmxx.png" alt=""><b>加盟热线 </b> Quick Navgation</div>
			<div style="text-align:center;line-height:35px;font-size:30px;color:#fff;margin-top:20px;">
				<div>加盟热线：</div>
				<div><?php echo $setting['jmrx'];?></div>
				<div style="font-size:8px;line-height:12px;font-family:微软雅黑;margin-top:10px;">QINGDAO PINDESHENGKE
					<br>RESTAURANT MANAGEMENT</div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>
<?php view("Content/foot"); ?>