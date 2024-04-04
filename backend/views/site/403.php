<?php
use yii\helpers\Url;
?>
<div class="wrap">
	<div class="logo-2 ">
			<p> خطا! شما به صفحه مورد نظر دسترسی ندارید...</p>
			<img src="<?= Yii::$app->urlManager->createUrl('upload') ?>/403.png">
			
<!---728x90--->
			<div class="sub-2">
                            <p><a href="<?= Url::to(['site/index'])?>">بازگشت به صفحه اصلی </a></p>
			</div>
	</div>
 </div>