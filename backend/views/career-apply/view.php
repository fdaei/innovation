<?php

use common\models\CareerApply;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/** @var View $this */
/** @var CareerApply $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Career Applies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="org-unit-view">
    <div class="card material-card">
            <!-- Card -->
            <div class="card text-left mx-auto col-12">
                <div class="card-body">
                    <label class="text-muted"><?= Yii::t('app', 'Status') ?></label>
                    <h6 class="card-title border-bottom m-2 pb-3 text-muted"> <?= CareerApply::itemAlias('Status', $model->status); ?></h6>
                    <label><?= Yii::t('app', 'First Name') ?></label>
                    <h6 class="card-title border-bottom m-2 pb-3"><?= $model->first_name ?></h6>
                    <label><?= Yii::t('app', 'Last Name') ?></label>
                    <h6 class="card-title border-bottom m-2 pb-3"><?= $model->last_name ?></h6>
                    <label><?= Yii::t('app', 'Mobile') ?></label>
                    <p class="card-text border-bottom m-2 pb-3"><?= $model->mobile ?></p>
                    <label><?= Yii::t('app', 'Email') ?></label>
                    <p class="card-text border-bottom m-2 pb-3"><?= $model->email ?></p>
                    <label><?= Yii::t('app', 'Job Positions') ?></label>
                    <p class="card-text border-bottom m-2 pb-3"><?= $model->jobPosition->title ?></p>
                    <label><?= Yii::t('app', 'cv_file') ?></label>
                    <p class="card-text border-bottom m-2 pb-3">
                        <?=
                              Html::a(Html::tag('i', '', ['class' => 'fas fa-download']), $model->getUploadUrl('cv_file'), ['target' => '_blank', 'class' => '']);
                         ?></p>
                    <label><?= Yii::t('app', 'description') ?></label>
                    <p class="card-text border-bottom m-2 pb-3"><?= $model->description?></p>
                    <div class="mt-4">
                        <p>
                            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                                'class' => 'btn btn-outline-primary',
                                'data' => [
                                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                    'method' => 'post',
                                ],
                            ]) ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>