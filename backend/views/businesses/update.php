<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Businesses $model */

$this->title = 'ویرایش کسب و کار: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'کسب و کار ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="businesses-update">

    <?= $this->render('_form', [
        'model' => $model,
        'businessesSponsors' => $businessesSponsors,
        'businessesStatistics' => $businessesStatistics,
        'businessesServices' => $businessesServices,
        'businessesStory' => $businessesStory,

    ]) ?>

</div>
