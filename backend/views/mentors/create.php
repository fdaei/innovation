<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Mentors $model */

$this->title = Yii::t('app', 'Create Mentors');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mentors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mentors-create card material-card">
    <div class="card-header">
        <h3><?= Html::encode($this->title) ?></h3>
    </div>
     <div class="card-body">    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>
      </div></div>
