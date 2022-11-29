<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\CareerApply $model */

$this->title = Yii::t('app', 'Create Career Apply');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Career Applies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="career-apply-create card material-card">
    <div class="card-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
     <div class="card-body">    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>
      </div></div>
