<?php

use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/** @var yii\web\View $this */
/** @var yii\gii\generators\crud\Generator $generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var <?= ltrim($generator->modelClass, '\\') ?> $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">

    <?= "<?php " ?>$form = ActiveForm::begin(); ?>
    <?php echo '<div class="row justify-content-center">' ?>
<?php foreach ($generator->getColumnNames() as $attribute) {
    if (in_array($attribute, $safeAttributes)) {
        echo "<div class='col-md-8'> <?= " . $generator->generateActiveField($attribute) . " ?>\n\n  </div>";
    }
} ?>
    <?php echo '</div>' ?>
    <div class="form-group mb-0 card-footer d-flex justify-content-between">
        <div class="col-md-10 d-flex justify-content-end">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <?= "<?php " ?>ActiveForm::end(); ?>

</div>
