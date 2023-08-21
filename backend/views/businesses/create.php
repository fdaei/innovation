<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Businesses $model */

$this->title = Yii::t('app', 'Create Businesses');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Businesses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="businesses-create bg-white p-3">

    <h3 class="card-header"><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
