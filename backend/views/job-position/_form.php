<?php

use common\models\JobPosition;
use common\models\OrgUnit;
use froala\froalaeditor\FroalaEditorWidget;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\web\View;

/** @var View $this */
/** @var JobPosition $model */
/** @var ActiveForm $form */
?>

<div class="card">
    <?php $form = ActiveForm::begin(); ?>
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-8">
                <?= $form->field($model, 'org_unit_id')->widget(Select2::class, [
                    'data' => ArrayHelper::map(OrgUnit::find()->all(), 'id', 'title'),
                    'size' => Select2::MEDIUM,
                    'options' => ['placeholder' => Yii::t('app', 'CHOOSE OrgUnit')],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]);
                ?>
            </div>
            <div class="col-sm-8">
                <?= $form->field($model, 'status')->dropDownList(JobPosition::itemAlias('Status'), ['prompt' => Yii::t('app', 'Select Status')]) ?>
            </div>

            <div class="col-sm-8">
                <?= $form->field($model, 'description')->textarea(['rows' => '4']) ?>
            </div>
            <div class="col-sm-8">
                <?= FroalaEditorWidget::widget([
                    'model' => $model,
                    'attribute' => 'requirements',
                    'options' => [
                        'id' => 'froala-editor--text',
                    ],
                    'clientOptions' => [
                        'attribution' => 1,
                        'language' => 'fa',
                        'height' => 200,
//                        'imageUploadParam' => 'file',
//                        'imageUploadURL' => Url::to(['upload']),
//                        'imageManagerLoadURL' => Url::to(['/file-manager/find-files', 'class_name' => 'job-position']),
//                        'imageMaxSize' => 1024 * 1024 * 10,
//                        'videoUploadParam' => 'file',
//                        'videoUploadURL' => Url::to(['upload']),
//                        'videoMaxSize' => 1024 * 1024 * 50
                    ],
                ]);
                ?>
            </div>
            <div class="col-sm-8 mt-2">
                <?= $form->field($model, 'immediate')->checkbox() ?>
            </div>
        </div>
        <hr>
        <div class="form-group mb-0 card-footer d-flex justify-content-between">
            <div class="col-md-10 d-flex justify-content-end">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>