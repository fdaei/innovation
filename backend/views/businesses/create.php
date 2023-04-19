<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Businesses $model */

$this->title = 'ایجاد کسب و کار جدید';
$this->params['breadcrumbs'][] = ['label' => 'Businesses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="businesses-create">

    <?= $this->render('_form', [
        'model' => $model,
        'businessesSponsors' => $businessesSponsors,
        'businessesStatistics' => $businessesStatistics,
        'businessesServices' => $businessesServices,
        'businessesStory' => $businessesStory,
    ]) ?>


</div>
