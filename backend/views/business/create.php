<?php

use common\models\Business;
use yii\helpers\Html;
use yii\web\View;

/** @var View $this */
/** @var Business $model */

$this->title = Yii::t('app', 'Create Business');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Businesses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card material-card">
    <div class="card-header">
        <h3><?= Html::encode($this->title) ?></h3>
    </div>

    <div class="card-body">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>