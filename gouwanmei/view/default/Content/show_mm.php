{template "Content/head"}
{php $setting = CAT(30)}
{php $pid = $category['pid']}
{php $parent = CAT($category['pid']);}
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
		<div class="mm_right_show" style="min-height:470px;">
			<div class="title">{$title}</div>
			<div class="img" style="margin-top:30px;">
				<img src="{$img}" alt="{$title}" style="max-width:750px;">
			</div>
			<div class="description" style="margin-top:30px;background:#f4f4f4;padding:20px;color:#444;font-family:微软雅黑;">{$description}</div>
		</div>
	</div>
	<div class="clear"></div>
</div>
{template "Content/foot"}