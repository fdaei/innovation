<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\BusinessGallery $model */

$this->title = Yii::t('app', 'Create Business Gallery');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Business Galleries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card material-card text-left">
    <div class="card-header">
        <h3><?= Html::encode($this->title) ?></h3>
    </div>

    <div class="card-body ">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
