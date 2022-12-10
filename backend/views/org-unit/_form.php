<?php

use common\models\OrgUnit;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\OrgUnit $model */
/** @var yii\widgets\ActiveForm $form */
?>
<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"> </h4>
                <h6 class="card-subtitle"></h6>
            </div>
            <hr>
            <form class="form-horizontal">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="com12" class="col-sm-2 text-right control-label col-form-label"></label>
                        <div class="col-sm-8">
                            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                        </div>
                        <label for="com12" class="col-sm-2 text-right control-label col-form-label"></label>
                    </div>
                    <div class="form-group row">
                        <label for="com12" class="col-sm-2 text-right control-label col-form-label"></label>
                        <div class="col-sm-8">
                            <?= $form->field($model, 'status')->dropDownList(OrgUnit::itemAlias('Status'),['prompt'=>Yii::t('app','Select Status')]) ?>
                        </div>
                        <label for="com12" class="col-sm-2 text-right control-label col-form-label"></label>
                    </div>
                    <div class="form-group row">
                        <label for="com12" class="col-sm-2 text-right control-label col-form-label"></label>
                        <div class="col-sm-8">
                            <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>
                        </div>
                        <label for="com12" class="col-sm-2 text-right control-label col-form-label"></label>
                    </div>
                </div>
                <hr>
                <div class="card-body">
                    <div class="form-group mb-0 text-right row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8">
                            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
                        </div>
                        <div class="col-sm-2"></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
