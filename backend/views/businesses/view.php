<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Businesses $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Businesses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card card-body">

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
            'picture_desktop',
            'picture_mobile',
            'name',
            'description_brief',
            'description:ntext',
            'website',
            'telegram',
            'instagram',
            'whatsapp',
            'pic_main_desktop',
            'pic_main_mobile',
            'pic_small1_desktop',
            'pic_small1_mobile',
            'pic_small2_desktop',
            'pic_small2_mobile',
//            'statistics',
//            'services',
//            'investors',
            'status',
            'updated_at',
            'updated_by',
            'created_by',
            'created_at',
            'deleted_at',
        ],
    ]) ?>

</div>
