<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\BusinessesInvestors $model */

$this->title = Yii::t('app', 'Create Businesses Investors');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Businesses Investors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="businesses-investors-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
