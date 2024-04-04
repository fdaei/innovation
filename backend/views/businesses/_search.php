<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\BusinessSearch $model */
/** @var yii\bootstrap4\ActiveForm $form */
?>

<div class="businesses-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="row">
        <div class="col-3">
            <?= $form->field($model, 'name') ?>
        </div>
    </div>
<!--    --><?php // echo $form->field($model, 'business_color') ?>
<!---->
<!--    --><?php // echo $form->field($model, 'business_en_name') ?>
<!---->
<!--    --><?php // echo $form->field($model, 'description_brief') ?>
<!---->
<!--    --><?php // echo $form->field($model, 'description') ?>
<!---->
<!--    --><?php // echo $form->field($model, 'website') ?>
<!---->
<!--    --><?php // echo $form->field($model, 'telegram') ?>
<!---->
<!--    --><?php // echo $form->field($model, 'instagram') ?>
<!---->
<!--    --><?php // echo $form->field($model, 'whatsapp') ?>
<!---->
<!--    --><?php // echo $form->field($model, 'pic_main_desktop') ?>
<!---->
<!--    --><?php // echo $form->field($model, 'pic_main_mobile') ?>
<!---->
<!--    --><?php // echo $form->field($model, 'pic_small1_desktop') ?>
<!---->
<!--    --><?php // echo $form->field($model, 'pic_small1_mobile') ?>
<!---->
<!--    --><?php // echo $form->field($model, 'pic_small2_desktop') ?>
<!---->
<!--    --><?php // echo $form->field($model, 'pic_small2_mobile') ?>
<!---->
<!--    --><?php // echo $form->field($model, 'statistics') ?>
<!---->
<!--    --><?php // echo $form->field($model, 'services') ?>
<!---->
<!--    --><?php // echo $form->field($model, 'investors') ?>
<!---->
<!--    --><?php // echo $form->field($model, 'status') ?>
<!---->
<!--    --><?php // echo $form->field($model, 'updated_at') ?>
<!---->
<!--    --><?php // echo $form->field($model, 'updated_by') ?>
<!---->
<!--    --><?php // echo $form->field($model, 'created_by') ?>
<!---->
<!--    --><?php // echo $form->field($model, 'created_at') ?>
<!---->
<!--    --><?php // echo $form->field($model, 'deleted_at') ?>

<div class="form-group">
    <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
    <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>
