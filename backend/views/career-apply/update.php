<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\CareerApply $model */

$this->title = Yii::t('app', 'Update Career Apply: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Career Applies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="career-apply-update">
    <div class="card material-card">
        <div class="card-header">
    <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="card-body">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
        </div>
</div>
