<?php

use common\models\JobPosition;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\JobPosition $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Job Positions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="org-unit-view">
    <div class="card ">
        <div class="card-header">
            <?= Yii::t('app', 'title') ?>
            <h6 class="card-title  m-2 pb-3"><?= $model->title ?></h6>
        </div>
        <div class="card-body">
        <label><?= Yii::t('app', 'org_unit') ?></label>
        <h6 class="card-title border-bottom m-2 pb-3"><?= $model->orgUnit->title ?></h6>
        <label><?= Yii::t('app', 'description') ?></label>
        <h6 class="card-title border-bottom m-2 pb-3"><?= $model->description ?></h6>
        <label><?= Yii::t('app', 'requirements') ?></label>
        <h6 class="card-title border-bottom m-2 pb-3">
            <?= $model->requirements ?>
        </h6>
        <div class="mt-4">
            <p>
                <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id],
                    ['class' => 'btn btn-primary ']) ?>
                <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-outline-primary ',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        </div>
    </div>
</div>
