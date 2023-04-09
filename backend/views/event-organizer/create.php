<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\EventOrganizer $model */

$this->title = 'Create Event Teachers';
$this->params['breadcrumbs'][] = ['label' => 'Event Teachers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-teachers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
