<?php

use yii\helpers\Url;

?>

<div class="card">
    <div class="card-body">
        <p>
            <?= Yii::t("app", $exception->getMessage()); ?>
        </p>
        <img src="<?= Yii::$app->urlManager->createUrl('upload') ?>/404.png">
        <!---728x90--->
        <div class="sub-2">
            <p><a href="<?= Yii::$app->urlManagerFrontend->createUrl(['site/index']) ?>">بازگشت به صفحه اصلی </a></p>
        </div>
    </div>
</div>