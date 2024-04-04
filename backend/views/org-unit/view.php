<?php

use common\models\OrgUnit;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\OrgUnit $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Org Units'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="org-unit-view">
    <div class="card">
        <div class="card-header">
            <label><?=Yii::t('app', 'title')?></label>
            <h6 class="card-title"><?=$model->title?></h6>
        </div>
                <div class="card-body">
                    <label><?=Yii::t('app', 'description')?></label>
                    <p class="card-text"><?=$model->description?></p>
                </div>
        <div class="card-footer">
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id],
                ['class' => 'btn btn-outline-primary ']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-primary ',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        </div>
    </div>
</div>