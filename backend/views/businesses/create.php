<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Businesses $model */

$this->title = 'Create Businesses';
$this->params['breadcrumbs'][] = ['label' => 'Businesses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="businesses-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'businessesSponsors' => $businessesSponsors,
        'businessesStatistics' => $businessesStatistics,
        'businessesServices' => $businessesServices,
        'businessesStory' => $businessesStory,
    ]) ?>


</div>
