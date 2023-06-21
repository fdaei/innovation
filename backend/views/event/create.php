<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Event $model */

$this->title = Yii::t('app', 'Create Event');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Events'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-create material-card bg-white">
    <div class="card-body">
        <?= $this->render('_form', [
            'model' => $model,
            'EventTimes' => $EventTimes,
        ]) ?>
    </div>
</div>
<script>
    window.addEventListener('load', (event) => {
        createMap("event");
    });
</script>