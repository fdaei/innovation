<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\BusinessGallery $model */

$this->title = Yii::t('app', 'Update Business Gallery: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Business Galleries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="card material-card">
    <div class="card-header">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="card-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
