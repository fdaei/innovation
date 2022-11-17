<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\BusinessStat $model */

$this->title = Yii::t('app', 'Update Business Stat: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Business Stats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
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
