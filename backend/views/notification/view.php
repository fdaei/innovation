<?php

use common\models\Notification;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Notification $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Notifications'), 'url' => ['index']];
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
                        <h6 class="card-title border-bottom m-2 pb-3 text-muted"> <?= Notification::itemAlias('Status',$model->status);?></h6>
                        <label><?=Yii::t('app', 'user_id')?></label>
                        <h6 class="card-title border-bottom m-2 pb-3"><?=$model->user->username?></h6>
                        <label><?=Yii::t('app', 'Type')?></label>
                        <h6 class="card-title border-bottom m-2 pb-3"><?= Notification::itemAlias('Type',$model->type);?></h6>
                        <label><?=Yii::t('app', 'receiver')?></label>
                        <h6 class="card-title border-bottom m-2 pb-3"><?=$model->receiver?></h6>
                        <label><?=Yii::t('app', 'text')?></label>
                        <h6 class="card-title border-bottom m-2 pb-3">
                            <?=$model->text?>
                        </h6>
                        <label><?=Yii::t('app', 'priority')?></label>
                        <h6 class="card-title border-bottom m-2 pb-3">
                            <?=$model->priority?>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
