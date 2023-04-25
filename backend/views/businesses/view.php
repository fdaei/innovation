<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Businesses $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Businesses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="businesses-view">
    <!-- HTML code for navbar with tabs -->
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#tab1" data-pjax="1">Tab 1</a></li>
        <li><a data-toggle="tab" href="#tab2" data-pjax="1">Tab 2</a></li>
        <li><a data-toggle="tab" href="#tab3" data-pjax="1">Tab 3</a></li>
    </ul>

    <!-- HTML code for tab content -->
    <div class="tab-content">
        <div id="tab1" class="tab-pane fade in active">
            <?php \yii\widgets\Pjax::begin(['id' => 'pjax-tab1']); ?>
            <!-- Render data for tab 1 -->
            <?php \yii\widgets\Pjax::end(); ?>
        </div>
        <div id="tab2" class="tab-pane fade">
            <?php \yii\widgets\Pjax::begin(['id' => 'pjax-tab2']); ?>
            <!-- Render data for tab 2 -->
            <?php \yii\widgets\Pjax::end(); ?>
        </div>
        <div id="tab3" class="tab-pane fade">
            <?php \yii\widgets\Pjax::begin(['id' => 'pjax-tab3']); ?>
            <!-- Render data for tab 3 -->
            <?php \yii\widgets\Pjax::end(); ?>
        </div>
    </div>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'picture_desktop',
            'picture_mobile',
            'name',
            'business_logo',
            'business_color',
            'business_en_name',
            'description_brief',
            'description:ntext',
            'website',
            'telegram',
            'instagram',
            'whatsapp',
            'pic_main_desktop',
            'pic_main_mobile',
            'pic_small1_desktop',
            'pic_small1_mobile',
            'pic_small2_desktop',
            'pic_small2_mobile',
            'statistics',
            'services',
            'investors',
            'status',
            'updated_at',
            'updated_by',
            'created_by',
            'created_at',
            'deleted_at',
        ],
    ]) ?>

</div>
