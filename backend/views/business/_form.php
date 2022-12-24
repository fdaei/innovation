<?php

use common\models\Business;
use common\models\City;
use common\models\User;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;

/** @var View $this */
/** @var Business $model */
/** @var ActiveForm $form */
?>

<div class="business-form">
    <?php $form = ActiveForm::begin(['enableClientValidation' => true,
        'options' => [
            'id' => 'dynamic-form'
        ]]); ?>
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <?=
                $form->field($model, 'user_id')->widget(Select2::class, [
                    'data' => ArrayHelper::map(User::find()->all(), 'id', 'username'),
                    'options' => ['placeholder' => Yii::t('app', 'Select user')],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>
            </div>
            <div class="col-md-8">
                <?=
                $form->field($model, 'city_id')->widget(Select2::class, [
                    'data' => ArrayHelper::map(City::find()->all(), 'id', 'name'),
                    'options' => ['placeholder' => Yii::t('app', 'Select city')],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>
            </div>
            <div class="col-md-8">
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-8">
                <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-8">
                <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-8">
                <?= $form->field($model, 'status')->dropDownList(Business::itemAlias('Status'), ['prompt' => Yii::t('app', 'Select Status')]) ?>
            </div>
            <div class="col-md-8">
                <?= $form->field($model, 'logo')->widget(FileInput::class, [
                    'name' => 'attachment_3',
                    'options' => ['accept' => 'image/*'],
                ]); ?>
            </div>
            <div class="col-md-8">
                <?= $form->field($model, 'wallpaper')->widget(FileInput::class, [
                    'name' => 'attachment_3',
                    'options' => ['accept' => 'image/*'],
                ])->hint(' width:1920 height:348 '); ?>
            </div>
            <div class="col-md-8">
                <?= $form->field($model, 'mobile_wallpaper')->widget(FileInput::class, [
                    'name' => 'attachment_3',
                    'options' => ['accept' => 'image/*'],
                ])->hint(' width:360px height:348px'); ?>
            </div>
            <div class="col-md-8">
                <?= $form->field($model, 'tablet_wallpaper')->widget(FileInput::class, [
                    'name' => 'attachment_3',
                    'options' => ['accept' => 'image/*'],
                ])->hint(' width:1023px height:990px'); ?>
            </div>
            <div class="col-md-8">
                <?= $form->field($model, 'short_description')->textarea(['rows' => 6]) ?>
            </div>
            <div class="col-md-8">
                <?= $form->field($model, 'investor_description')->textarea(['rows' => 6]) ?>
            </div>
            <div class="col-md-8">
                <?= $form->field($model, 'success_story')->textarea(['rows' => 6]) ?>
            </div>

        </div>

        <div class="form-group mb-0 card-footer d-flex justify-content-between">
            <div class="col-md-10 d-flex justify-content-end">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-info btn-rounded']) ?>
            </div>
        </div>
        <?php ActiveForm::end();?>
    </div>
</div>