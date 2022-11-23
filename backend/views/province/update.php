<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Province $model */

$this->title = Yii::t('app', 'Update Province: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Provinces'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="province-update">
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
