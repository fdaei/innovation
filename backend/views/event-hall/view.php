<?php

use common\models\EventHallPriceList;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\EventHall $model */
/** @var common\models\EventHallPriceList $price */
/** @var common\models\EventHallReserved $reserve */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Event Halls'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="event-hall-view">
    <div class="card material-card">
        <div class="container-fluid">
            <div class="container">
                <div class="mt-3 d-flex justify-content-between">
                    <div class="d-flex">
                        <h1 class="text text-info"><?= $model->name ?></h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card mb-4">
                            <div class="card-body">

                                <table class="table table-borderless">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <h4 class="small"><?= Yii::t('app', 'capacity') ?></h4>
                                        </td>
                                        <td>
                                            <h4 class="small"><?= $model->capacity ?></h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4 class="small"><?= Yii::t('app', 'branche_id') ?></h4>
                                        </td>
                                        <td>
<!--                                            <h4 class="small">--><?php //= $model->branche ?><!--</h4>-->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4 class="small"><?= Yii::t('app', 'rules') ?></h4>
                                        </td>
                                        <td>
                                            <h4 class="small"><?= $model->rules ?></h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4 class="small"><?= Yii::t('app', 'specifications') ?></h4>
                                        </td>
                                        <td>
                                            <h4 class="small"><?= $model->specifications ?></h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4 class="small"><?= Yii::t('app', 'description') ?></h4>
                                        </td>
                                        <td>
                                            <h4 class="small"><?= $model->description ?></h4>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <input id="map-latitude" value="<?= $model->latitude ?>" style=" display: none;">
                        <input id="map-longitude" value="<?= $model->longitude ?>" style=" display: none;"
                        <p class="card-title border-bottom m-2 pb-3">
                        <div id="map" style="width: 100%;height: 300px;"></div>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 border-bottom my-2">
                        <?= Html::a(Yii::t('app', 'add price'),
                            ['/event-hall-price-list/create', 'id' => $model->id], ['class' => 'btn btn-info btn-rounded btn-sm']) ?>  </div>
                        <?php foreach ($price as $i => $item): ?>
                    <div class="col-sm-4 my-5 ">
                            <i class="fas fa-circle"></i>
                        <label class="kohl">روز هفته:</label>
                            <span><?= EventHallPriceList::itemAlias('Week',$item->day)  ?></span>
                        <label class="kohl">قیمت :</label>
                            <span><?= $item->price ?></span>
                            <span>
                            <?= Html::a(Yii::t('app', ' <i class="fas fa-trash"></i>'), ['/event-hall-price-list/delete', 'id' => $item->id], ['class' => 'btn btn-info btn-rounded float-right btn-sm', 'data-method' => 'post']) ?>
                            <?= Html::a(Yii::t('app', ' <i class="fas fa-pen"></i>'), ['/event-hall-price-list/update', 'id' => $item->id], ['class' => 'btn btn-outline-info btn-rounded float-right btn-sm']) ?>
                        </span>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="row">
                    <div class="col-12 border-bottom my-2 ">
                        <?= Html::a(Yii::t('app', 'add reserve'),
                            ['/event-hall-reserved/create', 'id' => $model->id], ['class' => 'btn btn-info btn-rounded btn-sm']) ?>
                    </div>
                    <?php foreach ($reserve as $i => $item): ?>
                        <div class="row">
                            <i class="fas fa-circle"></i>
                            <h6><?= $item->timestamp_start ?></h6>
                            <span><?= $item->timestamp_end ?></span>
                            <span>
                            <?= Html::a(Yii::t('app', ' <i class="fas fa-trash"></i>'), ['/event-hall-price-list/delete', 'id' => $item->id], ['class' => 'btn btn-info btn-rounded float-right btn-sm', 'data-method' => 'post']) ?>
                            <?= Html::a(Yii::t('app', ' <i class="fas fa-pen"></i>'), ['/event-hall-price-list/update', 'id' => $item->id], ['class' => 'btn btn-outline-info btn-rounded float-right btn-sm']) ?>
                        </span>
                        </div>
                    <?php endforeach; ?>
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