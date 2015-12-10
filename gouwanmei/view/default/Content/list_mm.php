{template "Content/head"}
{php $setting=CAT(30)}
{php $parent = CAT($pid)}
<div class="wrap" style="margin-top:10px;background:#fff;padding:10px;">
	<div class="left page_left">
		<div class="quick1 gsjs" style="margin-bottom:0;">
			<div class="head" style="background:#c883c0;">
				<img src="{IMG_PATH}jmxx.png">
				<div class="title" style="color:#910782"><b style="color:#910782;">优惠信息</b>Quick Navigation</div>
			</div>
			<div class="con" style="background:#81b6db;color:#910782;">
				<div>加盟热线：</div>
				<div>{$setting.jmrx}</div>
				<div style="font-family: 微软雅黑;font-size: 8px;font-weight: 700;">QINGDAO PINDESHENGKE</div>
				<div style="font-family: 微软雅黑;font-size: 8px;font-weight: 700;">RESTAURANT MANAGEMENT</div>
			</div>
		</div>
		<div class="quick2 gsjs">
			<div class="head" style="background:#FFF000;">
				<img src="{IMG_PATH}ksdh1.png">
				<div class="title"><b>{$parent.catname}</b>{$parent.enname}</div>
			</div>
			<div class="con" style="background:#c6e08f;">
				<ul>
				{php $cates = CATBC($pid)}
				{loop $cates $cat}
					<li><a href="{$cat.url}">{$cat.catname} {$cat.enname}</a></li>
				{/loop}
				</ul>
			</div>
		</div>
	</div>
	<div class="right">
		<div class="mm_right" style="min-height:470px;">
			{php $data = CLBC($cid,4,$page,'roll')}
			{loop $data $con}
			<div class="left mm">
				<a href="{$con.url}">
					<div class="imgs">
						<img src="{thumb($con['img'],365,220)}" alt="{$con.title}">
					</div>
					<div class="radius">{$con.title}</div>
					<div class="opacity"></div>
				</a>
			</div>
			{/loop}
			<div class="clear"></div>
		</div>
		<div id="pager">共{$resnum}条记录 {$pages} 第{$page}页/共{$allpages}页</div>
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
{template "Content/foot"}