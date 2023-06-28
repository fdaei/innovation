<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\file\FileInput;
use common\models\Freelancer;
use common\models\Province;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\Freelancer $model */
/** @var yii\bootstrap4\ActiveForm $form */
?>

<div class="card card-body">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4">
                <?= $form->field($model, 'freelancer_picture')->widget(FileInput::class, [
                    'options' => ['accept' => 'image/*'],
                    'pluginOptions' => [
                        'showUpload' => false
                    ]
                ]) ?>
        </div>
        <div class="col-md-4">
                <?= $form->field($model, 'header_picture_mobile')->widget(FileInput::class, [
                    'options' => ['accept' => 'image/*'],
                    'pluginOptions' => [
                        'showUpload' => false
                    ]
                ]) ?>
        </div>
        <div class="col-md-4">
                <?= $form->field($model, 'header_picture_desktop')->widget(FileInput::class, [
                    'options' => ['accept' => 'image/*'],
                    'pluginOptions' => [
                        'showUpload' => false
                    ]
                ]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'sex')->dropDownList(Freelancer::itemAlias('Sex')) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'province')->widget(Select2::class, [
                'data' => ArrayHelper::map(Province::find()->all(), 'id', 'name'),
                'size' => Select2::MEDIUM,
                'options' => ['placeholder' => Yii::t('app', 'Select Province')],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]);
            ?>
        </div>
        <div class="col-md-6">
            <?=
            $form->field($model, 'city')->widget(DepDrop::class, [
                'options' => ['id' => 'freelancer-city'],
                'data' => [$model->getCity()?->id => $model->getCity()?->name],
                'pluginOptions' => [
                    'depends' => ['freelancer-province'],
                    'placeholder' => Yii::t('app', 'Select...'),
                    'url' => Url::to(['/province/get-cities'])
                ]
            ]);
            ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'marital_status')->dropDownList(Freelancer::itemAlias('Marital')) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'military_service_status')->dropDownList(Freelancer::itemAlias('Military')) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'activity_field')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'experience')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'experience_period')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'record_job')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'record_educational')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'portfolio')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'project_number')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'skills')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'status')->dropDownList(Freelancer::itemAlias('Status')) ?>
        </div>
        <div class="col-md-6">
                <?= $form->field($model, 'resume_file')->widget(FileInput::class, [
                    'options' => ['accept' => 'application/pdf,image/*'],
                    'pluginOptions' => [
                        'showPreview' => false,
                        'showCaption' => true,
                        'showRemove' => true,
                        'showUpload' => false
                    ]
                ]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'freelancer_description')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'description_user')->textarea(['rows' => 6]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
