<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\EventOrganizer $model */

$this->title = 'Update Event Teachers: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Event Teachers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="event-teachers-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
