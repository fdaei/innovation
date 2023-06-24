<?php

use common\models\Event;
use common\models\EventTime;
use yii\web\View;

/** @var View $this */
/** @var Event $model */
/** @var EventTime[] $EventTimes */

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