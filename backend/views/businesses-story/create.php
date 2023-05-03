<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\BusinessesStory $model */

$this->title = Yii::t('app', 'Create Businesses Story');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Businesses Stories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="businesses-story-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
