<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\FreelancerSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="freelancer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'header_picture_desktop') ?>

    <?= $form->field($model, 'header_picture_mobile') ?>

    <?= $form->field($model, 'freelancer_picture') ?>

    <?= $form->field($model, 'freelancer_description') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'sex') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'mobile') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'province') ?>

    <?php // echo $form->field($model, 'marital_status') ?>

    <?php // echo $form->field($model, 'military_service_status') ?>

    <?php // echo $form->field($model, 'activity_field') ?>

    <?php // echo $form->field($model, 'experience') ?>

    <?php // echo $form->field($model, 'experience_period') ?>

    <?php // echo $form->field($model, 'skills') ?>

    <?php // echo $form->field($model, 'record_job') ?>

    <?php // echo $form->field($model, 'record_educational') ?>

    <?php // echo $form->field($model, 'portfolio') ?>

    <?php // echo $form->field($model, 'resume_file') ?>

    <?php // echo $form->field($model, 'description_user') ?>

    <?php // echo $form->field($model, 'project_number') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'deleted_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
