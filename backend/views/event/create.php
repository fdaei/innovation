<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Event $model */

$this->title = Yii::t('app', 'Create Event');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Events'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-create card material-card">
    <div class="card-header kohl">
        <h3><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="card-body">
        <?= $this->render('_form', [
            'model' => $model,
            'eventHeadlines' => $eventHeadlines,
            'eventTimes' => $eventTimes,
            'eventSponsors' => $eventSponsors,
        ]) ?>
    </div>
</div>
<script>
    window.addEventListener('load', (event) => {
        createMap("event");
    });
</script>