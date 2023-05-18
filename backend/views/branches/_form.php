<?php

use common\models\Statuses;
use common\models\User;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Branches $model */
/** @var common\models\BranchesAdmin $admin */
/** @var yii\bootstrap4\ActiveForm $form */
?>

<div class="branches-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row justify-content-center">
        <div class='col-md-8 row'>
            <div class='col-md-6'>
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            </div>
            <div class='col-md-6'>
                <?=
                $form->field($admin, 'admin_id')->widget(Select2::class, [
                    'data' => ArrayHelper::map(User::find()->all(), 'id', 'username'),
                    'options' => ['placeholder' => Yii::t('app', 'Select user')],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>
            </div>
            <div class='col-md-6'>
                <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>
            </div>
            <div class='col-md-6'>
                <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
            </div>
            <span class='col-md-12'>
                 <p  class="card-title border-bottom m-2 pb-3">
                <div id="map" style="width: 100%;height: 400px;"></div>
                </p>
                <?= $form->field($model, 'longitude')->textInput(['style'=>'display: none'])->label(false) ?>
                <?= $form->field($model, 'latitude')->textInput(['style'=>'display: none'])->label(false) ?>
            </span>
            <span class='col-md-6'>
               <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
            </span>
            <span class='col-md-6'>
                <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
            </span>
            <span class='col-md-6'>
                <?= $form->field($model, 'desk_count')->textInput() ?>
            </span>
            <span class='col-md-6'>
                   <?=
                   $form->field($model, 'status')->widget(Select2::class, [
                       'data' => ArrayHelper::map(Statuses::find()->onCondition(['type' => 'branches'])->all(), 'id', 'title_fa'),
                       'options' => ['placeholder' => Yii::t('app', 'Select Status')],
                       'pluginOptions' => [
                           'allowClear' => true
                       ],
                   ]);
                   ?>
            </span>
            <div class="col-md-12">
                <?= $form->field($model, 'image')->widget(FileInput::class, [
                    'name' => 'attachment_3',
                    'options' => ['accept' => 'image/*'],
                ])->hint('width:2560 px height:320 px'); ?>
            </div>
        </div>
    </div>
    <div class="form-group mb-0 card-footer d-flex justify-content-between">
        <div class="col-md-10 d-flex justify-content-end">
            <button type="submit" class="btn btn-info btn-rounded">ثبت</button>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
