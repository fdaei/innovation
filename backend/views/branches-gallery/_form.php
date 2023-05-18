<?php

use common\models\Branches;
use common\models\Statuses;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\BranchesGallery $model */
/** @var yii\bootstrap4\ActiveForm $form */
?>

<div class="branches-gallery-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <?= $form->field($model, 'image')->widget(FileInput::class, [
                'name' => 'attachment_3',
                'options' => ['accept' => 'image/*'],
            ])->hint('width:2560 px height:320 px'); ?>
        </div>
        <div class="col-md-8">
            <?= $form->field($model, 'mobile_image')->widget(FileInput::class, [
                'name' => 'attachment_3',
                'options' => ['accept' => 'image/*'],
            ])->hint('width:360 px  height:320 px'); ?>
        </div>
        <div class="col-md-8">
            <?= $form->field($model, 'tablet_image')->widget(FileInput::class, [
                'name' => 'attachment_3',
                'options' => ['accept' => 'image/*'],
            ])->hint('width: 768 px  height:320 px'); ?>
        </div>
        <div class='col-md-8'>
            <?=
            $form->field($model, 'status')->widget(Select2::class, [
                'data' => ArrayHelper::map(Statuses::find()->onCondition(['type'=>'branches-gallery'])->all(), 'id', 'title_fa'),
                'options' => ['placeholder' => Yii::t('app', 'Select Status')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
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
