<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\BusinessTimelineItem $model */

$this->title = Yii::t('app', 'Create Business Timeline Item');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Business Timeline Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-timeline-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
