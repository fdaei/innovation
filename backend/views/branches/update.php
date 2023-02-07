<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Branches $model */
/** @var common\models\BranchesAdmin $admin */

$this->title = Yii::t('app', 'Update Branches: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Branches'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="branches-update">
    <div class="card material-card">
        <div class="card-header">
    <h3><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="card-body">
    <?= $this->render('_form', [
        'model' => $model,
        'admin' => $admin,
    ]) ?>
        </div>
</div>
