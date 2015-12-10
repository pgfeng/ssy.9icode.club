{template "Content/head"}
{php $setting = CAT(30)}
{php $pid=22}
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
	<div class="right new_right">
		<div class="top"><b>{$category.catname}</b>{$category.enname}</div>
		<div class="new_content">
			<div class="top">
				<div class="title">{$title}</div>
				<div class="smt">发表时间:{date("Y-m-d H:i:s",$inputtime)}</div>
			</div>
			<div class="content" style="min-height:400px;">{$content}</div>
			<div class="bottom">
				{if $previous}
					<div class="left">上一篇：<a href="{$previous.url}" style="color:#4292c9;">{$previous.title}</a></div>
				{/if}
				{if $next}
					<div class="right">下一篇：<a href="{$next.url}" style="color:#4292c9;">{$next.title}</a></div>
				{/if}
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>
{template "Content/foot"}