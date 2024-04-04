<?php

use yii\helpers\Html;
?>

<div class="card">
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <!--                <h1>ورود دو مرحله ای</h1>-->
                <p class="_ap">بعد از نصب
                    برنامه <?= Html::a('Google Authenticator', 'https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en') ?>
                    بارکد زیر را توسط برنامه اسکن کنید و سپس کد دریافت شده را وارد کنید</p>
                <hr>
                <?= Html::beginForm(['/site/scan'], 'POST'); ?>
                <div class="_aform">
                    <?php if (Yii::$app->session->getFlash('error')): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= Yii::$app->session->getFlash('error') ?>
                        </div>
                    <?php endif;

                    if (isset($qrCodeUrl)) {
                        ?>

                        <img class="img-fluid" src="<?php echo $qrCodeUrl ?>" alt="Verify this Google Authenticator">
                        <br><br>
                    <?php } ?>
                    <p class="_ap">کد دریافتی از Google Authenticator را در فیلد زیر وارد کنید</p>

                    <input type="text" class="form-control" name="code" placeholder="******"><br> <br>
                    <button type="submit" class="btn btn-md btn-primary">اعتبار سنجی</button>

                </div>

                <?= Html::endForm(); ?>
            </div>
        </div>
    </div>
</div>
