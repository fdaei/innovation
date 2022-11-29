<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\JobPosition $model */

$this->title = Yii::t('app', 'Create Job Position');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Job Positions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-position-create card material-card">
    <div class="card-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
     <div class="card-body">    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>
      </div></div>
