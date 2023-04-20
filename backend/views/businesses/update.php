<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Businesses $model */

$this->title = 'Update Businesses: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Businesses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="businesses-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'businessesSponsors' => $businessesSponsors,
        'businessesStatistics' => $businessesStatistics,
        'businessesServices' => $businessesServices,
        'businessesStory' => $businessesStory,
    ]) ?>

</div>
