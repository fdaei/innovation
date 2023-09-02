<?php

use common\models\OrgUnit;
use yii\helpers\Html;
use yii\web\View;
use yii\bootstrap4\ActiveForm;

/** @var View $this */
/** @var OrgUnit $model */
/** @var ActiveForm $form */
?>
<?php $form = ActiveForm::begin(['id' => 'org-unit-form']); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <form class="form-horizontal">
                <div class="card-body">
                    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>
                </div>

                <div class="form-group mb-0 text-right row">
                    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
                </div>
            </form>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
