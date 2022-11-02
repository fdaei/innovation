<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\BusinessTimeline $model */

$this->title = Yii::t('app', 'Create Business Timeline');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Business Timelines'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-timeline-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
