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
    <div class="card material-card">
        <div class="card-header d-flex justify-content-between row">
            <!-- Card -->
            <div class="card text-left mx-auto col-12">
                <div class="card-body">
                    <label class="text-muted"><?=Yii::t('app', 'Status')?></label>
                    <h6 class="card-title border-bottom m-2 pb-3 text-muted"> <?=OrgUnit::itemAlias('Status',$model->status);?></h6>
                    <label><?=Yii::t('app', 'title')?></label>
                    <h6 class="card-title border-bottom m-2 pb-3"><?=$model->title?></h6>
                    <label><?=Yii::t('app', 'description')?></label>
                    <p class="card-text"><?=$model->description?></p>
                    <div class="mt-4">
                    <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id],
                        ['class' => 'btn btn-primary']) ?>
                    <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                            'method' => 'post',
                        ],
                    ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>