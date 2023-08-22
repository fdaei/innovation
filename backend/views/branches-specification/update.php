<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\BranchesSpecification $model */

$this->title = Yii::t('app', 'Update Branches Specification: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Branches Specifications'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="branches-specification-update">
    <div class="card material-card">
        <div class="card-header">
    <h3><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="card-body">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
        </div>
</div>
