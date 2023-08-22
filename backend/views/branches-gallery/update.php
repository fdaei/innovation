<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\BranchesGallery $model */

$this->title = Yii::t('app', 'Update Branches Gallery: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Branches Galleries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="branches-gallery-update">
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
