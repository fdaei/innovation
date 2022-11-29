<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\OrgUnit $model */

$this->title = Yii::t('app', 'Update Org Unit: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Org Units'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="org-unit-update">
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
