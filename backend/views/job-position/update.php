<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\JobPosition $model */

$this->title = Yii::t('app', 'Update Job Position: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Job Positions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="job-position-update">
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
