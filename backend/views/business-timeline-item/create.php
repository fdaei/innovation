<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\BusinessTimelineItem $model */

$this->title = Yii::t('app', 'Create Business Timeline Item');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Business Timeline Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-timeline-item-create card material-card">
    <div class="card-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
     <div class="card-body">    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>
      </div></div>
