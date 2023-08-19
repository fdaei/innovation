<?php

use common\models\MentorsAdviceRequest;
use common\models\Statuses;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\MentorsAdviceRequest $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mentors Advice Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
    <div class="mentor-view">
        <div class="card-header d-flex justify-content-between row">
            <!-- Card -->
            <div class="card text-left mx-auto col-12">
                <div class="card-body row">
<!--                    <div class="col-3">-->
<!--                        <label class="text-muted">--><?php //= Yii::t('app', 'status') ?><!--</label>-->
<!--                        <p class="card-title border-bottom m-2 pb-3">--><?php //= Statuses::find()->where(['id' => $model->status])->one()->title_fa; ?><!--</p>-->
<!--                    </div>-->
                    <div class="col-3">
                        <label><?= Yii::t('app', 'Name') ?></label>
                        <p class="card-title border-bottom m-2 pb-3"><?= $model->user->username ?></p>
                    </div>
                    <div class="col-3">
                        <label><?= Yii::t('app', 'mentor') ?></label>
                        <p class="card-title border-bottom m-2 pb-3"><?= $model->mentor->name?></p>
                    </div >
<!--                    <div class="col-3">-->
<!--                        <label>--><?php //= Yii::t('app', 'file') ?><!--</label>-->
<!--                        <p class="card-text border-bottom m-2 pb-3">-->
<!--                            <a href="--><?php //= $model->getUploadUrl('file') ?><!--" download>-->
<!--                                <button class="btn btn-success"><i class="fas fa-download"></i></button>-->
<!--                            </a>-->
<!--                    </div>-->
                    <div class="col-3">
                        <label><?= Yii::t('app', 'description') ?></label>
                        <p class="card-title border-bottom m-2 pb-3"><?= $model->description ?></p>
                    </div>
<!--                    <div class="col-3">-->
<!--                        <label>--><?php //= Yii::t('app', 'date_advice') ?><!--</label>-->
<!--                        <p class="card-title border-bottom m-2 pb-3">--><?php //= $model->date_advice ?><!--</p>-->
<!--                    </div>-->
<!--                    <div class="col-3">-->
<!--                        <label>--><?php //= Yii::t('app', 'Twitter') ?><!--</label>-->
<!--                        <p class="card-title border-bottom m-2 pb-3"> --><?php //= MentorsAdviceRequest::itemAlias('TYPE', $model->type); ?><!--</p>-->
<!--                    </div>-->
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
