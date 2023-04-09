<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\EventOrganizer $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Event Teachers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="event-teachers-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'organizer_name',
            'organizer_avatar',
            'organizer_picture',
            'organizer_title_brief',
            'organizer_instagram',
            'organizer_telegram',
            'organizer_linkedin',
            'updated_at',
            'updated_by',
            'created_at',
            'created_by',
            'deleted_at',
        ],
    ]) ?>

</div>
