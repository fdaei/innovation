<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use common\widgets\ClockWidget;
use himiklab\yii2\recaptcha\ReCaptcha2;
use yii\captcha\Captcha;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

?>

<?php Pjax::begin([
    'id' => 'login-pjax-container', 'timeout' => false, 'enablePushState' => false,
    'options' => [
        'data' => [
            'show-preloader' => 0
        ],
        'class' => 'h-100'
    ]
]) ?>
<div class="card text-left mb-0">
    <div class="logo">
        <a href="<?= Yii::$app->getHomeUrl() ?>">
            <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="40mm" height="13mm"
                 version="1.1"
                 style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                 viewBox="0 9700 20000 500"
                 aria-label="<?= Yii::$app->name ?>"
                 xmlns:xlink="http://www.w3.org/1999/xlink">
                <title><?= Yii::$app->name ?></title>
                <g id="Layer_x0020_1">
                    <path fill="#00ACEE"
                          d="M4236 9220l1171 0 361 1748c14,65 92,513 132,573l486 -2321 1171 0c11,290 153,1550 185,1868 35,342 24,593 199,829 139,187 379,312 715,312l1070 0c296,0 489,-56 595,-258 147,-279 139,-1089 90,-1439 -23,-166 -56,-223 -100,-356l879 0c59,248 87,567 87,839 0,704 -45,1437 -558,1775 -424,279 -1351,192 -1919,192 -576,0 -1216,18 -1592,-519 -178,-254 -209,-439 -249,-805 -16,-141 -78,-884 -116,-944l-465 2255 -954 0c-26,-129 -454,-2189 -495,-2269l-221 2269 -833 0 360 -3747zm9412 0l3653 -1 0 763 -1012 0 0 2985 -840 0 0 -2982c-162,-6 -851,-14 -963,5l1 2977 -839 -5 0 -3741zm-2704 3706c107,-72 159,-127 237,-241 96,-141 132,-250 195,-427l634 0c320,0 635,58 635,-421 0,-252 -78,-488 -345,-488l-825 0 5 -693 747 0c510,0 407,-699 145,-699l-2704 0c-278,0 -431,84 -510,300 -68,187 -93,498 -93,712 0,437 -16,575 99,998l-869 0c-9,-119 -36,-244 -48,-374 -40,-470 -29,-1023 84,-1469 75,-297 182,-477 352,-646 360,-356 1111,-288 1722,-288 667,0 1345,-12 2010,0 1066,19 1153,1069 868,1549 -85,143 -191,215 -373,278 164,69 276,87 416,283 291,407 294,1506 -637,1664 -302,51 -1454,29 -1841,29l96 -68z"/>
                </g>
            </svg>
        </a>
    </div>
    <?php $form = ActiveForm::begin([
        'id' => 'forgot_password_form_step_2',
        'options' => [
            'data-pjax' => true,
            'class' => 'wait-loading'
        ],
        'enableClientValidation' => false,
        'validateOnSubmit' => true,
        'action' => Url::to(['/site/validate-code-forgot-password']),
    ]); ?>
    <div class="card-body pb-0 d-flex justify-content-center flex-column">
        <div>
            <div class="alert alert-info font-10">
                رمز جدید باید حداقل ۶ حرف و از الفبای انگلیسی و اعداد تشکیل شده باشد.
            </div>
            <?= $form->field($model, 'code')->textInput([
                'placeholder' => Yii::t('app', 'Enter verification code'),
                'maxlength' => '6',
                'autofocus' => 'autofocus',
                'dir' => 'ltr',
                'inputmode' => 'numeric',
                'pattern' => "[0-9]*",
                'autocomplete' => 'off',
                'class' => 'form-control login-input no-clear text-center',
            ]) ?>
            <?= $form->field($model, 'password')->passwordInput([
                'placeholder' => Yii::t('app', 'Enter new password'),
                'dir' => 'ltr',
                'autocomplete' => 'off',
                'class' => 'form-control login-input no-clear text-center',
            ]) ?>
            <?= $form->field($model, 'password_repeat')->passwordInput([
                'placeholder' => Yii::t('app', 'Enter new password again'),
                'dir' => 'ltr',
                'autocomplete' => 'off',
                'class' => 'form-control login-input no-clear text-center',
            ]) ?>
            <?php if (Yii::$app->session->get('hashCode')): ?>
                <div id="send-again-box" class="d-none mb-1 mt-0 font-10">
                    <span class="ml-1">کد را دریافت نکردید؟</span>
                    <?= Html::a(Yii::t('front', 'Send Again'), ['/site/send-again', 'modal' => false, 'scenario' => $model->scenario], ['class' => 'text-info send-again-btn']) ?>
                </div>
            <?php endif; ?>
            <?= ClockWidget::widget([
                'date' => $model->getTimeExpireCode() * 1000,
                'server_time' => time() * 1000,
                'show_days' => false,
                'show_hours' => false,
                'clockRedirectKeyPrefix' => 'front',
                'return_url' => Url::to(['/site/forgot-password']),
                'ajaxUrl' => Url::to(['/site/is-guest']),
                'clockText' => $model->sendAgain ? ':زمان مانده تا منقضی شدن کد تایید' : ':زمان مانده تا امکان ارسال مجدد کد تایید'
            ]) ?>
            <div class="alert alert-warning font-10 mb-0 text-center"><?= 'کد تایید به ' . $model->number . ' ارسال شده است.' ?></div>

            <div class="d-flex mb-1 mt-0 font-10">
                <span class="ml-1">شماره موبایل اشتباه است؟</span>
                <?= Html::a('ویرایش شماره', ['/site/forgot-password'], ['class' => 'text-info']) ?>
            </div>
            <?= $model->show_captcha ?
                $form->field($model, 'captcha')->widget(Captcha::className(), [
                    'captchaAction' => Url::to('/site/captcha'),
                    'template' => "<div class='d-flex justify-content-between align-items-center text-center'>{input}{image}</div>",
                    'imageOptions' => [
                        'class' => 'rounded-pill ml-2',
                        'style' => 'cursor:pointer; height:35px;',
                        'title' => Yii::t('app', 'Click to refresh the code'),
                    ],
                    'options' => [
                        'placeholder' => Yii::t('app', 'Captcha'),
                        'class' => 'form-control rounded-pill text-center mr-0 mr-lg-3 no-clear',
                        'inputmode' => 'numeric',
                        'pattern' => "[0-9]*",
                    ],
                ])->label(false)
                : '' ?>

            <?= 1 == 0 ?
                $form->field($model, 'captcha',
                    [
                        'template' => "<div class='d-flex flex-column align-items-center'>{input}\n{label}\n{hint}\n{error}</div>"
                    ])
                    ->widget(ReCaptcha2::className(), [
                        'widgetOptions' => ['class' => 'd-flex justify-content-center']
                    ])
                    ->label(false)
                : '' ?>

            <div class="d-flex border-0 my-2 justify-content-center">
                <?= Html::submitButton(Yii::t('app', 'Submit new password'), ['class' => 'btn btn-ajax btn-primary btn-block rounded px-3 py-1 font-15', 'name' => 'login-button']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<?php
$clockRedirect = (integer)(!Yii::$app->session->has('hashCode'));
$scriptLocalStorage = <<< JS
localStorage.setItem('back-clock-redirect', $clockRedirect);

$('.send-again-btn').on('click', function(e) {
  $(this).html('<i class="fas fa-spinner fa-pulse"></i>').attr('disabled', true);
});
JS;
$this->registerJs($scriptLocalStorage);

?>
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
Pjax::end() ?>
