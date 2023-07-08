<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\FreelancerCategoryList $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Freelancer Category Lists'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="request-leave-view">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="panel-title mt-2">
                <?= Html::encode($this->title) ?>
            </h4>
            <div>
                <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
        </div>

        <div class="card-body">

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'title',
                    'brief_description',
                    [
                        'attribute' => 'picture',
                        'value' => $model->getUploadUrl('picture'),
                        'format' => $model->picture ? ['image',['width'=>'100','height'=>'100']] : null,
                    ],
                ],
            ]) ?>

        </div>
    </div>
</div>
