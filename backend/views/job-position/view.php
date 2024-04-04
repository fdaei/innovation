<?php
use common\models\JobPosition;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\JobPosition $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Job Positions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="org-unit-view">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"><?= Yii::t('app', 'Job Position Details') ?></h4>
        </div>
        <div class="card-body">
            <h5 class="card-subtitle mb-2 text-muted"><?= Yii::t('app', 'Title') ?></h5>
            <p class="card-text"><?= $model->title ?></p>

            <h5 class="card-subtitle mb-2 text-muted"><?= Yii::t('app', 'Organization Unit') ?></h5>
            <p class="card-text"><?= $model->orgUnit->title ?></p>

            <h5 class="card-subtitle mb-2 text-muted"><?= Yii::t('app', 'Description') ?></h5>
            <p class="card-text"><?= $model->description ?></p>

            <h5 class="card-subtitle mb-2 text-muted"><?= Yii::t('app', 'Requirements') ?></h5>
            <p class="card-text"><?= $model->requirements ?></p>
        </div>
    </div>
</div>
