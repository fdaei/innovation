<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Event $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Events'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="event-view">
    <div class="card material-card">
        <div class="card-header d-flex justify-content-between row">
            <!-- Card -->
            <div class="card text-left mx-auto col-12">
                <div class="card-body row">
                    <div class="col-4">
                        <label class="kohl"><?= Yii::t('app', 'title') ?></label>
                        <h6 class="card-title border-bottom m-2 pb-3 "> <?= $model->title ?></h6>
                    </div>
                    <div class="col-4">
                        <label class="kohl"><?= Yii::t('app', 'price') ?></label>
                        <p class="card-title border-bottom m-2 pb-3"><?= $model->price ?></p>
                    </div>
                    <div class="col-4">
                        <label class="kohl"><?= Yii::t('app', 'price_before_discount') ?></label>
                        <p class="card-title border-bottom m-2 pb-3"><?= $model->price_before_discount ?></p>
                    </div>

                    <div class="col-4">
                        <label class="kohl"><?= Yii::t('app', 'description') ?></label>
                        <p class="card-title border-bottom m-2 pb-3"><?= $model->description ?></p>
                    </div>
                    <div class="col-4">
                        <?php foreach ($model->headlines as $value): ?>
                            <label>سرفصل</label>
                            <p class="card-title  m-2 pb-3 "><?= $value["'title'"] ?></p>
                            <label>محتوای هر سر فصل</label>
                            <p class="card-title  m-2 pb-3 "><?= $value["'description'"] ?></p>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-4">
                        <label class="kohl"><?= Yii::t('app', 'sponsors') ?></label>
                        <p class="card-title border-bottom m-2 pb-3"><?= $model->sponsors ?></p>
                    </div>
                    <div class="col-4">
                        <label class="kohl"><?= Yii::t('app', 'event_times') ?></label>
                        <?php foreach ($model->event_times as $value): ?>
                            <p class="card-title border-bottom m-2 pb-3"><?= $value ?></p>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-4">
                        <label class="kohl"><?= Yii::t('app', 'address') ?></label>
                        <p class="card-title border-bottom m-2 pb-3"><?= $model->address ?></p>
                    </div>
                    <input id="map-latitude" value="<?= $model->latitude ?>" style=" display: none;">
                    <input id="map-longitude" value="<?= $model->longitude ?>" style=" display: none;"
                    <p class="card-title border-bottom m-2 pb-3">
                    <div id="map" style="width: 100%;height: 400px;"></div>
                    </p>
                    <div class="col-12">
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
    <script>
        window.addEventListener('load', (event) => {
            viewMap();
        });
    </script>
