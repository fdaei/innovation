<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Statuses $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Statuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
    <div class="statuses-view">
        <div class="card material-card">
            <div class="card-header d-flex justify-content-between row">
                <!-- Card -->
                <div class="card text-left mx-auto col-12">
                    <div class="card-body">
                        <label><?= Yii::t('app', 'Title_en') ?></label>
                        <p class="card-title border-bottom m-2 pb-3"><?= $model->title_en ?></p>
                        <label><?= Yii::t('app', 'Title_fa') ?></label>
                        <p class="card-title border-bottom m-2 pb-3"><?= $model->title_fa ?></p>
                        <label><?= Yii::t('app', 'Type') ?></label>
                        <p class="card-title border-bottom m-2 pb-3"><?= $model->type ?></p>
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
