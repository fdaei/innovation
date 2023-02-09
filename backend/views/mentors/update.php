<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Mentors $model */

$this->title = Yii::t('app', 'Update Mentors: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mentors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'user_id' => $model->user_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="mentors-update">
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
