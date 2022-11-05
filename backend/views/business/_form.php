<?php

use backend\models\City;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use aminbbb92\user\models\User;

/** @var yii\web\View $this */
/** @var backend\models\Business $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="business-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model,'user_id')->dropDownList(
    ArrayHelper::map(User::find()->all(),'id','username'),
    ['prompt'=>'Select user']
    )?>
    <?= $form->field($model,'city_id')->dropDownList(
        ArrayHelper::map(City::find()->all(),'id','name'),
        ['prompt'=>'Select city']
    )?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <br/>
    <?= $form->field($model, 'logo')->fileInput() ?>
    <br/>
    <?= $form->field($model, 'wallpaper')->fileInput() ?>
    <br/>
    <?= $form->field($model, 'short_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'success_story')->textarea(['rows' => 6]) ?>
    <?= $form->field($model,'status')->dropDownList( ['1' => 'active', '2' => 'inactive', '3' => 'deleted'])?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
