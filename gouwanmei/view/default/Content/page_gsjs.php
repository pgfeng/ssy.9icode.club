{template "Content/head"}
{php $setting = CAT(30)}
{if !$pid}
{php $pid=1}
{/if}
{php $parent = CAT($pid);}
<div class="wrap" style="margin-top:10px;background:#fff;padding:10px;">
	<div class="left page_left">
		<div class="quick1 gsjs">
			<div class="head">
				<img src="{IMG_PATH}jmxx.png">
				<div class="title"><b>优惠信息</b>Quick Navigation</div>
			</div>
			<div class="con">
				<div>加盟热线：</div>
				<div>{$setting.jmrx}</div>
								<div style="font-family: 微软雅黑;font-size: 8px;font-weight: 700;">QINGDAO PINDESHENGKE</div>
				<div style="font-family: 微软雅黑;font-size: 8px;font-weight: 700;">RESTAURANT MANAGEMENT</div>
			</div>
		</div>
		<div class="quick2 gsjs">
			<div class="head">
				<img src="{IMG_PATH}ksdh.png">
				<div class="title"><b>{$parent.catname}</b>{$parent.enname}</div>
			</div>
			<div class="con">
				<ul>
				{php $cates = CATBC($pid)}
				{loop $cates $cat}
					<li><a href="{$cat.url}">{$cat.catname} {$cat.enname}</a></li>
				{/loop}
				</ul>
			</div>
		</div>
	</div>
	<div class='right page_right'>
		<div class="title">
			<div class="catname">{$catname}</div>
			<div class="enname">{$enname}</div>
		</div>
		<div class="content">
			{$content}
		</div>
	</div>
	<div class="clear"></div>
</div>
{template "Content/foot"}