<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Mentors $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mentors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="mentors-view">
    <div class="card material-card">
        <div class="card-header d-flex justify-content-between">
            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                <?= Html::a(Yii::t('app', 'Update'), ['update', 'user_id' => $model->user_id],
                ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'user_id' => $model->user_id], [
                'class' => 'btn btn-danger',
                'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
                ],
                ]) ?>
            </p>
        </div>
        <div class="card-body">
            <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                        'user_id',
            'name',
            'telegram',
            'instagram',
            'whatsapp',
            'activity_field',
            'profile_pic',
            'activity_description:ntext',
            'consulting_fee',
            'consultation_face_to_face',
            'consultation_online',
            'services',
            'records',
            'status',
            'updated_at',
            'updated_by',
            'created_by',
            'created_at',
            'deleted_at',
            ],
            ]) ?>
        </div>
    </div>
