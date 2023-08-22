<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\MentorCategory $model */

$this->title = Yii::t('app', 'Create Mentor Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mentor Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mentor-category-create card material-card">
    <div class="card-header">
        <h3><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="card-body">    <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
