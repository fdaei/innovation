<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */


$this->title = $name;
?>
<div class="site-error text-left">

    <h1 class="text-center dir-ltr"><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        <?= Yii::t('app', 'The above error occurred while the Web server was processing your request.') ?>
    </p>
    <p>
        <?= Yii::t('app', 'Please contact us if you think this is a server error. Thank you.') ?>
    </p>
    <div class="row">
        <div class="col-md-12 mt-2">
            <?= Html::a('<i class="fas fa-home"></i> ' . Yii::t('app', 'Home'), ['/site/index'], ['class' => 'btn btn-info btn-block', 'title' => 'برگشت به صفحه نخست']) ?>
        </div>
        <?php if (!Yii::$app->user->isGuest): ?>
            <div class="col-md-12 mt-2">
                <?php Pjax::begin(['id' => 'error-page']) ?>
                <?= Html::a('<i class="fas fa-bug"></i> ' . Yii::t('app', 'Report Bug'),
                    'javascript:void(0)', [
                        'title' => 'ارسال گزارش خطا به مدیر سیستم',
                        'id' => 'report-bug',
                        'class' => 'btn btn-primary btn-block',
                        'data-size' => 'modal-lg',
                        'data-title' => 'ارسال گزارش خطا به مدیر سیستم',
                        'data-toggle' => 'modal',
                        'data-target' => '#modal-pjax',
                        'data-url' => Url::to(['/site/report-bug', 'title' => $name, 'message' => $message, 'url' => Yii::$app->request->url, 'referrer' => Yii::$app->request->referrer]),
                        'data-reload-pjax-container-on-show' => 0,
                        //'data-reload-pjax-container' => 'p-jax-payment-period',
                        'data-handleFormSubmit' => 1,
                        'disabled' => true
                    ]); ?>
                <?php Pjax::end() ?>
            </div>
        <?php endif; ?>
        <div class="col-md-12 mt-2">
            <?= Html::a('<i class="fas fa-power-off"></i> ' . Yii::t('app', 'Logout'), ['/site/logout'], ['class' => 'btn btn-danger btn-block', 'data-method' => "post", 'title' => 'خروج از سیستم']) ?>
        </div>
    </div>
</div>
