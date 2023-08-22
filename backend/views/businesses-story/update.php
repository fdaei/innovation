<?php

use backend\models\BusinessStoryText;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\BusinessesStory $model */
/** @var BusinessStoryText $businessesText */

$this->title = Yii::t('app', 'Update Businesses Story: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Businesses Stories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="businesses-story-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'businessesText'=>$businessesText
    ]) ?>

</div>
