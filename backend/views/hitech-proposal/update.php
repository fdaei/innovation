<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\HitechProposal $model */

$this->title = 'Update Hitech Proposal: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Hitech Proposals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hitech-proposal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
