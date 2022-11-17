<?php

use common\models\Business;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/** @var View $this */
/** @var Business $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Businesses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card material-card">
    <div class="card-header d-flex justify-content-between">
        <h3><?= Html::encode($this->title) ?></h3>
        <p>
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
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
                'id',
                'user_id',
                'city_id',
                'title',
                'slug',
                'link',
                'logo',
                'wallpaper',
                'investor_description',
                'short_description:ntext',
                'success_story:ntext',
                'status',
                'created_at',
                'created_by',
                'updated_at',
                'updated_by',
                'deleted_at',
            ],
        ]) ?>
    </div>
</div>