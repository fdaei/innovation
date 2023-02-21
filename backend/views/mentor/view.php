<?php

use common\models\Statuses;
use voime\GoogleMaps\Map;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Mentor $model */

$this->title = $model->name;
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
                    <label class="text-muted"><?= Yii::t('app', 'status') ?></label>
                    <p class="card-title border-bottom m-2 pb-3"><?= Statuses::find()->where(['id' => $model->status])->one()->title_fa; ?></p>
                </div>
                <div class="col-3">
                    <label><?= Yii::t('app', 'Name') ?></label>
                    <p class="card-title border-bottom m-2 pb-3"><?= $model->name ?></p>
                </div>
                <div class="col-3">
                    <label><?= Yii::t('app', 'mobile') ?></label>
                    <p class="card-title border-bottom m-2 pb-3"><?= $model->mobile?></p>
                </div class="col-3">
                <div class="col-3">
                    <label><?= Yii::t('app', 'Resume') ?></label>
                    <p class="card-text border-bottom m-2 pb-3">
                        <a href="<?= $model->getUploadUrl('Resume') ?>" download><button class="btn btn-success"><i class="fas fa-download"></i></button></a>
                </div>
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
                    <label><?= Yii::t('app', 'Job Records')?></label>
                    <p class="card-title border-bottom m-2 pb-3"><?= $model->job_records ?></p>
                </div>
                <div class="col-3">
                    <label><?= Yii::t('app', 'Education Records') ?></label>
                    <p class="card-title border-bottom m-2 pb-3"><?= $model->education_records ?></p>
                </div>
                <div class="col-3">
                    <label><?= Yii::t('app', 'Documents') ?></label>
                    <p class="card-title border-bottom m-2 pb-3"><?= $model->documents ?></p>
                </div>
                <div class="col-3">
                    <label><?= Yii::t('app', 'records') ?></label>
                    <p class="card-title border-bottom m-2 pb-3"><?= $model->records ?></p>
                </div>
                <div class="col-3">
                    <label><?= Yii::t('app', 'consultation_face_to_face') ?></label>
                    <p class="card-title border-bottom m-2 pb-3"><?= $model->consultation_face_to_face ?></p>
                </div>
                <div class="col-3">
                    <label><?= Yii::t('app', 'consultation_online') ?></label>
                    <p class="card-title border-bottom m-2 pb-3"><?= $model->consultation_online ?></p>
                </div>
                <div class="col-3">
                    <label><?= Yii::t('app', 'services') ?></label>
                    <p class="card-title border-bottom m-2 pb-3"><?= $model->services ?></p>
                </div>
                <div class="col-3">
                    <label><?= Yii::t('app', 'activity_field') ?></label>
                    <p class="card-title border-bottom m-2 pb-3"><?= $model->activity_field ?></p>
                </div>
                <div class="col-3">
                    <label><?= Yii::t('app', 'activity_description') ?></label>
                    <p class="card-title border-bottom m-2 pb-3"><?= $model->	activity_description ?></p>
                </div>
                <div class="col-3">
                    <label><?= Yii::t('app', 'consulting_fee') ?></label>
                    <p class="card-title border-bottom m-2 pb-3"><?= $model->consulting_fee ?></p>
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
                    <label><?= Yii::t('app', 'description') ?></label>
                    <p class="card-title border-bottom m-2 pb-3"><?= $model->description ?></p>
                </div>
                <div class="col-3">
                    <label><?= Yii::t('app', 'Education Records') ?></label>
                    <p class="card-title border-bottom m-2 pb-3"><?= $model->description ?></p>
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
