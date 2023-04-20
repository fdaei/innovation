<?php

use common\models\Statuses;
use voime\GoogleMaps\Map;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Mentor $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mentors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="mentor-view">
    <div class="card-header d-flex justify-content-between row">
        <!-- Card -->
        <div class="card text-left mx-auto col-12">
            <div class="card-body row">
                <div class="col-3">
                    <label><?= Yii::t('app', 'Instagram') ?></label>
                    <p class="card-title border-bottom m-2 pb-3"><?= $model->instagram ?></p>
                </div>
                <div class="col-3">
                    <label><?= Yii::t('app', 'Linkedin') ?></label>
                    <p class="card-title border-bottom m-2 pb-3"><?= $model->linkedin ?></p>
                </div>
                <div class="col-3">
                    <label><?= Yii::t('app', 'Twitter') ?></label>
                    <p class="card-title border-bottom m-2 pb-3"><?= $model->twitter ?></p>
                </div>
                <div class="col-3">
                    <label><?= Yii::t('app', 'activity_description') ?></label>
                    <p class="card-title border-bottom m-2 pb-3"><?= $model->	activity_description ?></p>
                </div>
                <div class="col-3">
                    <label><?= Yii::t('app', 'whatsapp') ?></label>
                    <p class="card-title border-bottom m-2 pb-3"><?= $model->whatsapp ?></p>
                </div>
                <div class="col-3">
                    <label><?= Yii::t('app', 'telegram') ?></label>
                    <p class="card-title border-bottom m-2 pb-3"><?= $model->telegram ?></p>
                </div>
                <div class="col-3">
                    <label><?= Yii::t('app', 'Picture') ?></label>
                    <p class="card-title  justify-content-center row">
                        <img class=" img-fluid"  src=<?= $model->getUploadUrl('picture') ?>>
                    </p>
                </div>
                <div class="col-3">
                    <label><?= Yii::t('app', 'Video') ?></label>
                    <p class="justify-content-center row">
                        <video width="100%"  controls>
                            <source src=<?= $model->getUploadUrl('video')?> type="video/mp4">
                        </video>
                    </p>
                </div>
                <div class="mt-4 col-12">
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
