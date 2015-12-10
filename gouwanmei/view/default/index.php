{template "Content/head"}
{php $setting = CAT(30)}
<div class="wrap">
	<div class="home_show">
		<div class="quick1">
			<div class="head" style="border-bottom: 2px solid #f9d18f;padding-bottom:10px;"><img src="{IMG_PATH}ksdh.png" alt=""><b>快速导航 </b> Quick Navgation</div>
			<div class="con">
				<ul class="dhlist">
					<li><a href="{$_CAT[14][url]}">{$_CAT[14][catname]} {$_CAT[14][enname]}</a></li>
					<li><a href="{$_CAT[15][url]}">{$_CAT[15][catname]} {$_CAT[15][enname]}</a></li>
					<li><a href="{$_CAT[5][url]}">{$_CAT[5][catname]} {$_CAT[5][enname]}</a></li>
					<li><a href="{$_CAT[26][url]}">{$_CAT[26][catname]} {$_CAT[26][enname]}</a></li>
					<li><a href="{$_CAT[2][url]}">{$_CAT[2][catname]} {$_CAT[2][enname]}</a></li>
					<li><a href="{$_CAT[24][url]}">{$_CAT[24][catname]} {$_CAT[24][enname]}</a></li>
					<div class="clear"></div>
				</ul>
			</div>
			<div class="clear"></div>
		</div>
		<div class="quick2">
			<div class="head" style="border-bottom: 2px solid #af4aa4;padding-bottom:6px;"><img src="{IMG_PATH}qydt.png" alt=""><b><a href="{$_CAT[22][url]}">企业动态</a> </b> Quick Navgation</div>
			{php $contents = CLBC(31,9)}
			<div class="con">
				{loop $contents $con}
					<ul>
						<li>
							<a href="{$con.url}" style="display:block;width:100%;"><div class="left">{str_cut($con['title'],15)}</div><div class="right">{date("Y-m-d",$con['inputtime'])}</div><div class="clear"></div></a>
						</li>
					</ul>
				{/loop}
			</div>
		</div>
		<div class="quick3" style="">
		<div class="head" style="border-bottom: 2px solid #af4aa4;padding-bottom:6px;"><img src="{IMG_PATH}qydt.png" alt=""><b>宣传视频 </b> Quick Navgation</div>
			<video width="300" controls="controls" style="margin-top: 84px;">  
        		<source src="{$setting.video}" type="video/mp4" ></source>  
        		您的浏览器不支持video标签  
    		</video>
		</div>
		<div class="quick4">
			<div class="head" style="border-bottom: 2px solid #a7d053;padding-bottom:8px;padding-top:5px;"><img src="{IMG_PATH}stdm.png" alt=""><b><a href="{$_CAT[29][url]}">店面展示</a> </b> Quick Navgation</div>
			<div class="con">
				{php $data = CLBM(85,2)}
				{loop $data $con}
					<div class="left" style="margin-left:12px;">
						<a href="{$con.url}"><img src="{thumb($con['img'],130,130)}" alt="{$con.title}"></a>
					</div>
				{/loop}
				<div class="clear"></div>
			</div>
		</div>
		<div class="quick5">
			<div class="head" style="border-bottom: 2px solid #ed589c;padding-bottom:6px;"><img src="{IMG_PATH}jmxx.png" alt=""><b><a href="{$_CAT[23][url]}">加盟信息</a> </b> Quick Navgation</div>
			<div class="con">
				<ul>
					{php $data = CLBC(23,4)}
					{loop $data $con}
					<li><a href="{$con.url}" style="display:block;width:100%;"><div class="left">{str_cut($con['title'],13)}</div><div class="right">{date("Y-m-d",$con['inputtime'])}</div><div class="clear"></div></a></li>
					{/loop}
				</ul>
			</div>
		</div>
		<div class="quick6">
			<div class="head"><img src="{IMG_PATH}jmxx.png" alt=""><b>加盟热线 </b> Quick Navgation</div>
			<div style="text-align:center;line-height:35px;font-size:30px;color:#fff;margin-top:20px;">
				<div>加盟热线：</div>
				<div>{$setting['jmrx']}</div>
				<div style="font-size:8px;line-height:12px;font-family:微软雅黑;margin-top:10px;">QINGDAO PINDESHENGKE
					<br>RESTAURANT MANAGEMENT</div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>
{template "Content/foot"}