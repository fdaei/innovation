<?php
use yii\helpers\Html;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\widgets\ActiveForm;

/** @var yii\widgets\ActiveForm $form */
/** @var \common\models\Businesses $model */


$form = ActiveForm::begin(); // Start the ActiveForm
?>

<div class="row bg-white p-3 rounded my-3">
    <div class="card card-body">
        <?php
        DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapper1',
            'widgetBody' => '.container-items-statistics',
            'widgetItem' => '.item-statistics',
            'limit' => 4,
            'min' => 1,
            'insertButton' => '.add-item-statistics',
            'deleteButton' => '.remove-item-statistics',
            'model' => $BusinessesServices[0],
            'formId' => 'businesses_form',
            'formFields' => [
                'title',
                'description'
            ],
        ]); ?>
        <div class="container-items-statistics">
            <div>
                <h2 class="mb-4">اضافه کردن آمار</h2>
                <button type="button"
                        class="add-item-statistics btn  btn-xs float-right rounded-pill custom_background_color text-white">
                    آمار جدید
                </button>
            </div>
            <?php foreach ($BusinessesServices as $i => $modelAddress): ?>
                <div class="item-statistics panel panel-default" style="padding-right: 0px">
                    <div class="panel-body">
                        <?php
                        if (!$modelAddress->isNewRecord) {
                            echo Html::activeHiddenInput($modelAddress, "[{$i}]id");
                        }
                        ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($modelAddress, "[{$i}]title")->textInput(['class' => 'custom_input_search', 'maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelAddress, "[{$i}]description")->textarea(['class' => 'custom_input_search', 'rows' => 6, 'maxlength' => true]) ?>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="">
                            <button type="button"
                                    class="remove-item-statistics btn  btn-xs float-right rounded-pill custom_background_color2 text-white">
                                حذف
                            </button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php DynamicFormWidget::end(); ?>
    </div>
</div>
<?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?> <!-- Add a submit button -->
<?php ActiveForm::end(); // End the ActiveForm ?>
