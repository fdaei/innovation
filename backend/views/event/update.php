<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Event $model */

$this->title = Yii::t('app', 'Update Event: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Events'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="event-update">
    <div class="card material-card">
        <div class="card-header kohl">
            <h3><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="card-body">
            <?= $this->render('_form', [
                'model' => $model,
                'EventTimes' => $EventTimes,
            ]) ?>
        </div>
    </div>
</div>
<script>
    window.addEventListener('load', (event) => {
        createMap("event",<?=$model->latitude?>,<?=$model->longitude?>);
    });
</script>