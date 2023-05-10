<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Freelancer $model */

$this->title = 'Create Freelancer';
$this->params['breadcrumbs'][] = ['label' => 'Freelancers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="freelancer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
