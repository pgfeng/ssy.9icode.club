<?php defined('APP_PATH') or exit('Sorry,Please from entry!'); ?>
		<?php $setting = CAT(30)?>
		<hr style="margin:20px 0;">
		<div class="footer">
			<div class="con" style="color:#fff;">
				<div class="left">
					<div class="top">
						<div class="left">
							<div style="font-family: 微软雅黑;font-size: 12px;font-weight: 700;">QINGDAO PINDESHENGKE</div>
							<div style="font-family: 微软雅黑;font-size: 12px;font-weight: 700;">RESTAURANT MANAGEMENT</div>
							<div style="font-family: 微软雅黑;font-size: 8px;margin-top:30px;">www.pindeshengke.com</div>
						</div>
						<div class="left" style="color:#fff;font-size:10px;line-height:20px;margin-left:30px;">
							<div>Add.<?php echo $setting['catname']; ?></div>
							<div>Tel.<?php echo $setting['tel']; ?></div>
							<div>Fax.<?php echo $setting['fax']; ?></div>
							<div>E-mail.<?php echo $setting['email']; ?></div>
						</div>
					</div>
					<div class="clear"></div>
					<div class="bot" style="font-size:10px;margin-top:10px;">
						Copyright © 2015 kaorou.com All Rights Reserved 版权所有•十三月自主烤肉<br>
						浙ICP备14012994号-1
					</div>
				</div>
				<div class="right">
					<div class="left"><img src="<?php echo $this->var['view_vars']['img_path'];?>bottomimg.png"></div>
					<div class="right"><img src="<?php echo $setting['ewm']; ?>"></div>
				</div>
			</div>
		</div>
	</body>
</html>