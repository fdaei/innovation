<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\BranchesSpecification $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Branches Specifications'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
    <div class="card material-card">
        <div class="card-header d-flex justify-content-between row">
            <!-- Card -->
            <div class="card text-left mx-auto col-12">
                <div class="card-body">
                    <label class="text-muted"><?= Yii::t('app', 'branche') ?></label>
                    <h6 class="card-title border-bottom m-2 pb-3 text-muted"> <?=  $model->branche->title ?></h6>
                    <label><?= Yii::t('app', 'key') ?></label>
                    <p class="card-title border-bottom m-2 pb-3"><?= $model->key ?></p>
                    <label><?= Yii::t('app', 'value') ?></label>
                    <p class="card-title border-bottom m-2 pb-3"><?= $model->value?></p>
                    <div class="mt-4">
                        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id],
                            ['class' => 'btn btn-outline-primary']) ?>
                        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-primary',
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

