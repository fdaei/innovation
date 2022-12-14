<?php

use common\models\Province;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Province $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Provinces'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="org-unit-view">
    <div class="card material-card">
        <div class="card-header d-flex justify-content-between row">
            <!-- Card -->
            <div class="card text-left mx-auto col-12">
                <div class="card-body">
                    <label class="text-muted"><?= Yii::t('app', 'Status') ?></label>
                    <h6 class="card-title border-bottom m-2 pb-3 text-muted"> <?= Province::itemAlias('Status', $model->status); ?></h6>
                    <label><?= Yii::t('app', 'Provinces') ?></label>
                    <p class="card-title border-bottom m-2 pb-3"><?= $model->name ?></p>
                    <label><?= Yii::t('app', 'Center ID') ?></label>
                    <p class="card-title border-bottom m-2 pb-3"><?= $model->center->name ?></p>
                    <div class="mt-4">
                        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id],
                            ['class' => 'btn btn-outline-info btn-rounded']) ?>
                        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-info btn-rounded',
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
