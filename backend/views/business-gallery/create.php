<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\BusinessGallery $model */

$this->title = Yii::t('app', 'Create Business Gallery');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Business Galleries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-gallery-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
