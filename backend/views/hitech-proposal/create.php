<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\HitechProposal $model */

$this->title = 'Create Hitech Proposal';
$this->params['breadcrumbs'][] = ['label' => 'Hitech Proposals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hitech-proposal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
