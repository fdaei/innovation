<?php

use common\models\Statuses;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Branches $model */
/** @var common\models\BranchesSpecification $facilities */
/** @var common\models\BranchesGallery $gallery */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Branches'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card material-card">
    <div class="card-header d-flex justify-content-between row">
        <!-- Card -->
        <div class="card text-left mx-auto col-12">
            <div class="card-body">
                <label class="text-muted"><?= Yii::t('app', 'status') ?></label>
                <p class="card-title border-bottom m-2 pb-3"><?= Statuses::find()->where(['id' => $model->status])->one()->title_fa; ?></p>
                <label><?= Yii::t('app', 'title') ?></label>
                <h6 class="card-title border-bottom m-2 pb-3 text-muted"> <?= $model->title ?></h6>
                <label><?= Yii::t('app', 'address') ?></label>
                <p class="card-title border-bottom m-2 pb-3"><?= $model->address ?></p>
                <label><?= Yii::t('app', 'admin') ?></label>
                <p class="card-title border-bottom m-2 pb-3"><?= $model->branchesAdmins[0]->admin->username ?></p>
                <label><?= Yii::t('app', 'longitude') ?></label>
                <p class="card-title border-bottom m-2 pb-3"><?= $model->longitude ?></p>
                <label><?= Yii::t('app', 'latitude') ?></label>
                <p class="card-title border-bottom m-2 pb-3"><?= $model->latitude ?></p>
                <label><?= Yii::t('app', 'mobile') ?></label>
                <p class="card-title border-bottom m-2 pb-3"><?= $model->mobile ?></p>
                <label><?= Yii::t('app', 'phone') ?></label>
                <p class="card-title border-bottom m-2 pb-3"><?= $model->phone ?></p>
                <label><?= Yii::t('app', 'desk_count') ?></label>
                <p class="card-title border-bottom m-2 pb-3"><?= $model->desk_count ?></p>
                <label><?= Yii::t('app', 'description') ?></label>
                <p class="card-title border-bottom m-2 pb-3"><?= $model->description ?></p>
                <label><?= Yii::t('app', 'image') ?></label>
                <p class="card-title border-bottom m-2 pb-3">
                    <img class=" p-2 img-fluid " src=<?= $model->getUploadUrl('image') ?>>
                </p>
                <div class="p-2">
                    <h3 class="alert alert-light border border-1  p-3"><?= Yii::t('app', 'Galleries') ?>
                        <?= Html::a(Yii::t('app', 'Create Galleries'), ['/branches-gallery/create', 'id' => $model->id], ['class' => 'btn btn-info btn-rounded float-right']) ?>
                </div>
                <?php foreach ($gallery as $i => $item): ?>
                    <div class="p-2">
                        <div class="row my-1">
                            <div class="col-4"><span>تصویر دسکتاپ</span></div>
                            <div class="col-4"><span>تصویر موبایل </span></div>
                            <div class="col-4"><span>تصویر تبلت</span></div>
                        </div>
                        <div class="row">

                            <img class="col-4  img-fluid " src=<?= $item->getUploadUrl('image') ?>></p>
                            <img class="col-4   img-fluid " src=<?= $item->getUploadUrl('mobile_image') ?>></p>
                            <img class="col-4   img-fluid " src=<?= $item->getUploadUrl('tablet_image') ?>></p>
                            <div class="m-4">
                                <?= Html::a(Yii::t('app', ' <i class="fas fa-trash"></i>'), ['/branches-gallery/delete', 'id' => $item->id], ['class' => 'btn btn-info btn-rounded float-right btn-sm', 'data-method' => 'post']) ?>
                                <?= Html::a(Yii::t('app', ' <i class="fas fa-pen"></i>'), ['/branches-gallery/update', 'id' => $item->id], ['class' => 'btn btn-outline-info btn-rounded float-right btn-sm']) ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                </h3>
                <div>
                    <h3 class="alert alert-light border border-1 p-3"><?= Yii::t('app', 'Facilities') ?>
                        <?= Html::a(Yii::t('app', 'Create Facilities'), ['/branches-specification/create', 'id' => $model->id], ['class' => 'btn btn-info btn-rounded float-right']) ?>
                    </h3>
                    <?php foreach ($facilities as $i => $item): ?>
                        <div class="p-2">
                            <i class="fas fa-circle"></i>
                            <span><?= $item->key ?> : </span>
                            <span><?= $item->value ?></span>
                            <span>
                            <?= Html::a(Yii::t('app', ' <i class="fas fa-trash"></i>'), ['/branches-specification/delete', 'id' => $item->id], ['class' => 'btn btn-info btn-rounded float-right btn-sm', 'data-method' => 'post']) ?>
                            <?= Html::a(Yii::t('app', ' <i class="fas fa-pen"></i>'), ['/branches-specification/update', 'id' => $item->id], ['class' => 'btn btn-outline-info btn-rounded float-right btn-sm']) ?>
                        </span>
                        </div>
                    <?php endforeach; ?>
                </div>

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
