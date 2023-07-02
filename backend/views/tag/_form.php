<?php

use common\models\Tag;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Tag $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tag-form">

    <?php $form = ActiveForm::begin(['id'=>'tag-form']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList(Tag::itemAlias('Type'), ['prompt' => Yii::t('app', 'Select Tags')]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
