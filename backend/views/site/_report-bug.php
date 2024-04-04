<?php

use common\models\Comments;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Comments */
/* @var $form yii\widgets\ActiveForm */

?>
<div dir="rtl">
    <?php $form = ActiveForm::begin([
        'id'     => 'report-bug-form'
    ]); ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'css_class')->dropDownList(Comments::itemAlias('Type')) ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'des')->textarea(['rows' => 3]) ?>
        </div>
    </div>
    <div class="card-footer">
        <?= Html::submitButton(Yii::t('app','Create'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>