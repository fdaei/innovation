<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use himiklab\yii2\recaptcha\ReCaptcha2;
use yii\captcha\Captcha;
use yii\widgets\Pjax;

/* @var $this \yii\web\View */
/* @var $model \common\models\LoginForm */
?>
<?php Pjax::begin([
    'id' => 'login-pjax-container', 'timeout' => false, 'enablePushState' => false,
    'options' => [
        'data' => [
            'show-preloader' => 0
        ],
        'class' => ''
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
    <div class="card-body">
        <?php $form = ActiveForm::begin([
            'id' => 'forgot-password-form',
            'options' => [
                'data-pjax' => true,
                'class' => 'wait-loading'
            ],
            'action' => Url::to(['/site/forgot-password']),
        ]); ?>

        <div class="d-flex justify-content-center flex-column">
            <div>
                <div class="alert alert-info font-10">
                    اگر کلمه عبور خود را فراموش کرده اید، می توانید از طریق این صفحه یک رمز جدید تنظیم کنید.
                </div>
                <?= $form->field($model, 'number', [
                    'hintOptions' => [
                        'class' => 'd-flex align-items-center m-0'
                    ]
                ])->textInput([
                    'maxlength' => '11',
                    'placeholder' => Yii::t('app', 'Enter your mobile number'),
                    'autofocus' => 'autofocus',
                    'dir' => 'ltr',
                    'inputmode' => 'numeric',
                    'pattern' => "[0-9]*",
                    'autocomplete' => 'off',
                    'class' => 'form-control login-input no-clear text-center',
                ])->hint(Html::tag('i', '', ['class' => 'fal fa-info-circle ml-1']) . Html::tag('span', 'کد تایید به این شماره ارسال می شود', ['class' => 'text-muted font-10'])) ?>

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
                            'autocomplete' => 'off',
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
                    <?= Html::submitButton('<span class="">' . Yii::t('app', 'Take a verify code') . '</span>', ['class' => 'btn btn-ajax btn-primary btn-block px-3 py-1 font-15 d-flex align-items-center justify-content-center rounded', 'name' => 'login-button']) ?>
                </div>
            </div>
            <div class="alert alert-warning font-10 mb-0 text-center">
                <a href="<?= Url::to(['/site/login']) ?>">وارد شوید</a>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

<?php
$clockRedirect = (integer)(!Yii::$app->session->has('hashCode'));
$scriptLocalStorage = <<< JS
localStorage.setItem('back-forgot-password-clock-redirect', $clockRedirect);
JS;
$this->registerJs($scriptLocalStorage);
Pjax::end() ?>
