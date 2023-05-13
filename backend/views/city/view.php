<?php

use common\models\City;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\City $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card card-body">

    <div class="card-header">
        <div class="float-right">
            <?= Html::a('<i class="fa fa-pencil"></i>', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
            <?= Html::a('<i class="fa fa-trash"></i>', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th><?= Yii::t('app', 'name')?></th>
            <th><?= Yii::t('app', 'province')?></th>
            <th><?= Yii::t('app', 'latitude')?></th>
            <th><?= Yii::t('app', 'longitude')?></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?= $model->name ?></td>
            <td><?= $model->province->name ?></td>
            <td><?= $model->latitude ?></td>
            <td><?= $model->longitude ?></td>
        </tr>
        </tbody>
    </table>
</div>
