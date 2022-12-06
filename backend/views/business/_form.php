<?php

use common\models\Business;
use common\models\City;
use common\models\User;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;

/** @var View $this */
/** @var Business $model */
/** @var ActiveForm $form */
?>

<div class="business-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'user_id')->dropDownList(
                ArrayHelper::map(User::find()->all(), 'id', 'username'),
                ['prompt' => 'Select user']
            ) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'city_id')->dropDownList(
                ArrayHelper::map(City::find()->all(), 'id', 'name'),
                ['prompt' => 'Select city']
            ) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'status')->dropDownList(Business::itemAlias('Status'),['prompt'=>Yii::t('app','Select Status')]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'logo')->fileInput() ?>
        </div>
        <div class="col-md-3">
            <p>طول باید 1920 و عرض باید 348 باشد </p>
            <?= $form->field($model, 'wallpaper')->fileInput() ?>
        </div>
        <div class="col-md-3">
            <p>طول باید 360 و عرض باید 348 باشد </p>
            <?= $form->field($model, 'mobile_wallpaper')->fileInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'short_description')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'investor_description')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'success_story')->textarea(['rows' => 6]) ?>
        </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>