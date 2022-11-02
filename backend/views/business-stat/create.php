<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\BusinessStat $model */

$this->title = Yii::t('app', 'Create Business Stat');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Business Stats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-stat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
