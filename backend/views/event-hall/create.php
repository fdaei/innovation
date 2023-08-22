<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\EventHall $model */

$this->title = Yii::t('app', 'Create Event Hall');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Event Halls'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-hall-create card material-card">
    <div class="card-header">
        <h3><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="card-body">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
<script>
    window.addEventListener('load', (eventhall) => {
        createMap("eventhall");
    });
</script>