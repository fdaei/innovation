<?php

use common\widgets\ClockWidget;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\captcha\Captcha;

/** @var $model \common\models\LoginForm */
/** @var $type string */

$this->title = 'تایید کد';
?>
<?php Pjax::begin([
    'id'      => 'login-pjax-container', 'timeout' => false, 'enablePushState' => false,
    'options' => [
        'class' => 'h-100'
    ]
]) ?>
<div class="card text-left mb-0">
    <div class="logo">
        <a href="<?= Yii::$app->getHomeUrl() ?>">
           <?=Yii::$app->application->logo('dark', 0.4)?>
        </a>
    </div>
    <div class="card-body">
        <?php
        $form = ActiveForm::begin([
            'id'          => 'verify-form',
            'fieldConfig' => [
                'options' => [
                    'tag' => 'span',
                ],
            ],
            'options'     => [
                'data-pjax' => true,
            ],
            'action'      => Url::to(['/site/verify-code']),
        ]);
        ?>

        <span class="login100-form-title">
        <?= ClockWidget::widget([
            'date'                   => $model->getTimeExpireCode() * 1000,
            'server_time'            => time() * 1000,
            'show_days'              => false,
            'show_hours'             => false,
            'clockRedirectKeyPrefix' => 'back',
            'return_url'             => Url::to(['/site/login']),
            'ajaxUrl'                => Url::to(['/site/is-guest']),
            'clockText'              => $type == 'google' ? ':زمان باقیمانده تا انقضای ورود' : null,
        ]) ?>

            <?php if ($type == 'sms' || !$model->user->authenticator): ?>
                <?= $form->field($model, 'code',
                    [
                        'template'     => "<div class='input-group mb-3'>
                                            <div class='input-group-append'>
                                                <span class='input-group-text' id='basic-addon2'>
                                                    <i class='far fa-sms font-20'></i>
                                                </span>
                                            </div>{input}\n{label}\n{hint}\n{error}
                                       </div>",
                        'inputOptions' => [
                            'autofocus'        => 'autofocus',
                            'autocomplete'     => 'off',
                            'class'            => 'form-control form-control-lg text-center',
                            'tabindex'         => '1',
                            'aria-describedby' => 'basic-addon1',
                            'placeholder'      => Yii::t('app', 'Enter verify code'),
                            'maxlength'        => 6,
                            'inputmode'        => 'numeric',
                            'pattern'          => "[0-9]*",
                        ]
                    ]
                )->label(false);
                ?>
            <?php elseif ($type == 'google' || $model->user->authenticator): ?>
                <?= $form->field($model, 'authenticator',
                    [
                        'template'     => "<div class='input-group mb-3'>
                                            <div class='input-group-append'>
                                                <span class='input-group-text' id='basic-addon2'>
                                                   <i class='fab fa-google font-20'></i>
                                                </span>
                                            </div>{input}\n{label}\n{hint}\n{error}
                                       </div>",
                        'inputOptions' => [
                            'autofocus'        => 'autofocus',
                            'autocomplete'     => 'off',
                            'class'            => 'form-control form-control-lg text-center',
                            'tabindex'         => '1',
                            'aria-describedby' => 'basic-addon1',
                            'placeholder'      => Yii::t('app', 'Enter Google verify code'),
                        ]
                    ]
                )->label(false);
                ?>
            <?php endif; ?>
            <?php
            if ($model->user->password) {
                ?>
                <?= $form->field($model, 'password',
                    [
                        'template'     => "<div class='input-group mb-3'>
                                            <div class='input-group-append'>
                                                <span class='input-group-text' id='basic-addon2'>
                                                    <i class='fal fa-key'></i>
                                                </span>
                                            </div>{input}\n{label}\n{error}
                                       </div>\n{hint}",
                        'inputOptions' => [
                            'autocomplete'     => 'off',
                            'class'            => 'form-control form-control-lg text-center',
                            'tabindex'         => '1',
                            'aria-describedby' => 'basic-addon1',
                            'placeholder'      => 'کلمه عبور دو مرحله ای',
                            'maxlength'        => 72
                        ],
                        'hintOptions'  => [
                            'class' => 'd-flex align-items-center m-0'
                        ]
                    ]
                )->passwordInput()
                    ->label(false)
                    ->hint(Html::tag('i', '', ['class' => 'fal fa-undo mr-1']) . Html::a('فراموشی کلمه عبور', Url::to(['/site/forgot-password']), ['class' => 'font-10', 'data-pjax' => 0]));
            }
            ?>
            <?php if ($type == 'sms'): ?>
                <p class="text-center mb-1 mt-0">
            <?= Html::a(Html::encode($model->number) . Html::tag('i', '', ['class' => 'fal fa-edit']), ['/site/login'], ['class' => 'text-info']) ?>
        </p>
        <?php if (Yii::$app->session->get('hashCode')): ?>
                    <p class="text-center mb-1 mt-0">
                <?= Html::a(Yii::t('front', 'Send Again') . Html::tag('i', '', ['class' => 'fal fa-sms']), ['/site/send-again', 'modal' => false], ['class' => 'text-info send-again-btn']) ?>
            </p>
                <?php endif; ?>

            <?php endif; ?>

        <div class="my-3">
            <?= $model->show_captcha ?
                $form->field($model, 'captcha')->widget(Captcha::class, [
                    'captchaAction' => Url::to('/site/captcha'),
                    'template'      => "<div class='d-flex justify-content-between align-items-center text-center'>{input}{image}</div>",
                    'imageOptions'  => [
                        'class' => 'rounded-pill ml-2',
                        'style' => 'cursor:pointer; height:35px;',
                        'title' => Yii::t('app', 'Click to refresh the code'),
                    ],
                    'options'       => [
                        'placeholder'  => Yii::t('app', 'Captcha'),
                        'class'        => 'form-control rounded-pill text-center mr-0 mr-lg-3',
                        'inputmode'    => 'numeric',
                        'pattern'      => "[0-9]*",
                        'autocomplete' => 'off',
                    ],
                ])->label(false)
                : '' ?>
        </div>

        <div class="form-group text-center">
            <div class="col-xs-12 pb-3">
                <?= Html::submitButton(
                    'ورود',
                    ['class' => 'btn btn-block btn-lg btn-info', 'tabindex' => '4']
                ) ?>
            </div>
        </div>
    <?php if ($type == 'google'): ?>
        <div class="form-group text-center">
            <div class="col-xs-12 pb-3">
                <?= Html::a(
                    Yii::t('app', 'Login With SMS'),
                    ['/site/verify-code', 'type' => 'sms'],
                    ['class' => 'btn btn-block btn-lg btn-primary sms', 'tabindex' => '5']
                ) ?>
            </div>
        </div>
    <?php endif; ?>
            <?php
            ActiveForm::end();
            ?>
    </div>
</div>
<?php

if ($model->sendAgain) {
    $script = <<< JS
    swal({
        position: 'top-end',
        timer: 2000,
        title: "<span class='text-success'>کد احراز هویت مجددا ارسال شد.</span>",
        type: "success",
        background: '#d4edda',
        showConfirmButton: false,
        toast: true,
    });    
JS;
    $this->registerJs($script);
}
$clockRedirect = (integer)(!Yii::$app->session->has('hashCode'));
$js = <<<JS
verifyForm = $('#verify-form');
submitBtn = verifyForm.find(':submit');
verifyForm.on('beforeSubmit', function(e) {
  submitBtn.html('<i class="fas fa-spinner fa-pulse"></i>').attr('disabled', true)
});

smsBtn = verifyForm.find('.sms');
smsBtn.on('click', function(e) {
  smsBtn.html('<i class="fas fa-spinner fa-pulse"></i>').attr('disabled', true)
});

$('[data-toggle="tooltip"]').tooltip({container: 'body'})

localStorage.setItem('back-clock-redirect', $clockRedirect);

$('.send-again-btn').on('click', function(e) {
  $(this).html('<i class="fas fa-spinner fa-pulse"></i>').attr('disabled', true);
});
JS;

$this->registerJs($js);

Pjax::end();
?>

