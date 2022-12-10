<?php

use common\models\JobPosition;
use common\models\OrgUnit;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\JobPosition $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="job-position-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class='col-md-3'>
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'org_unit_id')->dropDownList(
                ArrayHelper::map(OrgUnit::find()->all(), 'id', 'title'),
                ['prompt' => 'Select org_unit']
            ) ?>
        </div>
        <div class='col-md-3'>
            <?= $form->field($model, 'description')->textarea(['rows' => '4']) ?>

        </div>
        <div class='col-md-3'>
<!--            --><?php //= $form->field($model, 'requirements')->textarea(['rows' => '4']) ?>
            <?php echo froala\froalaeditor\FroalaEditorWidget::widget([
                'model' => $model,
                'attribute' => 'requirements',
                'options' => [
                    // html attributes
                    'id'=>'content',
                ],
                'clientOptions' => [
                    'toolbarInline' => false,
                    'theme' => 'royal', //optional: dark, red, gray, royal
                    'language' => 'en_gb' // optional: ar, bs, cs, da, de, en_ca, en_gb, en_us ...
                ]
            ]); ?>

        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'status')->dropDownList(JobPosition::itemAlias('Status'),['prompt'=>Yii::t('app','Select Status')]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'immediate')->checkbox() ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
