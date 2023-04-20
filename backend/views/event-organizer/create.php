<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\EventOrganizer $model */

$this->title = 'برگذار کننده جدید';
$this->params['breadcrumbs'][] = ['label' => 'برگذار کنندگان', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-teachers-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
