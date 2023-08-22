<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\EventOrganizer $model */

$this->title = 'ویرایش: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'برگذار کنندگان', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'ویرایش';
?>
<div class="event-teachers-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
