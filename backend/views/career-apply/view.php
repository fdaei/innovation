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
<div class="career-apply-view">
    <div class="card material-card">
        <div class="card-header d-flex justify-content-between">
            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id],
                    ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        </div>
        <div class="card-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'first_name',
                    'last_name',
                    'mobile',
                    'email:email',
                    'job_position_id',
                    [
                        'attribute' => 'cv_file',
                        'value' => function (CareerApply $model) {
                            return Html::a(Html::tag('i', '', ['class' => 'fas fa-download']), $model->getUploadUrl('cv_file'), ['target' => '_blank', 'class' => '']);
                        },
                        'format' => 'raw'
                    ],
                    'description',
                    'status',
                    'created_at:datetime',
                    'updated_at:datetime',
                    'updated_by',
                ],
            ]) ?>
        </div>
    </div>