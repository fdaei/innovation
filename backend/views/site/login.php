<?php

use yii\web\View;
use common\models\LoginForm;
use yii\authclient\widgets\AuthChoice;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\captcha\Captcha;
use yii\widgets\Pjax;

/* @var $this View */
/* @var $form ActiveForm */
/* @var $model LoginForm */
/* @var $alert string */

$this->title = "ورود به حساب کاربری";
?>
<div class="content" style="margin-top: 17%">
    <div class="mt-5">
        <div class="row mt-5">
            <div class="col-md-6 order-md-2 hidden-sm text-center">
                <img src=<?= Yii::getAlias('@web') ?>'/img/login-logo.gif' alt="Image" class="img-fluid"
                     style="border: 125px;" width="350">
            </div>
            <div class="col-md-6 text-center">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="mb-4">
                            <img src=<?= Yii::getAlias('@web') ?>'/img/pmlm-logo.png' width="50">
                            <span class="text-primary font-20">سیستم مدیریت فرآیند کسب و کار</span>
                        </div>

                        <div class="card m-5">
                            <?php
                            $form = ActiveForm::begin([
                                'id' => 'login-form',
                                'options' => [
                                    'data-pjax' => true,
                                ],
                                'action' => Url::to(['/site/login']),
                                'fieldConfig' => [
                                    'options' => [
                                        'tag' => 'span',
                                    ],
                                ],
                            ]);
                            ?>

                            <?= $form->field($model, 'number',
                                [
                                    'template' => "<div class='input-group mb-3'>
                                                <div class='input-group-append'>
                                                    <span class='input-group-text' id='basic-addon2'>
                                                        <i class='far fa-mobile-alt'></i>
                                                    </span>
                                                </div>{input}\n{label}\n{hint}\n{error}
                                           </div>",
                                    'inputOptions' => [
                                        'autofocus' => 'autofocus',
                                        'autocomplete' => 'off',
                                        'class' => 'form-control form-control-lg text-center persian-to-english',
                                        'tabindex' => '1',
                                        'aria-describedby' => 'basic-addon1',
                                        'placeholder' => 'شماره تلفن همراه خود را وارد کنید',
                                        'inputmode' => 'numeric',
                                        'pattern' => "[0-9]*",
                                    ]
                                ]
                            )->label(false); ?>
                            <div class="form-group text-center">
                                <div class="col-xs-12 pb-3">
                                    <?= Html::submitButton(
                                        'ورود به حساب کاربری',
                                        ['class' => 'btn btn-block btn-lg btn-primary', 'name' => 'login-button']
                                    ) ?>
                                </div>
                                <p class="d-block text-center  text-muted" style="font-size: 12px;margin-top:8px;">
                                    <?= Html::a(
                                        '<span class="fas fa-unlock"></span> می خواهم با رمز عبور وارد شوم',
                                        ['site/login'],
                                        ['class' => 'link']
                                    ) ?>
                                    &nbsp; | &nbsp;
                                    <?= Html::a(
                                        '<span class="fas fa-user"></span> حساب کاربری ندارم',
                                        ['site/signup'],
                                        ['class' => 'link']
                                    ) ?>
                                </p>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

