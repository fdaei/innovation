<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\EventSponsors $model */

$this->title = Yii::t('app', 'Create Event Sponsors');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Event Sponsors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-sponsors-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
