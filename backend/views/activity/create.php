<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Activity $model */
/** @var common\models\ActivityUserAssignment $assignment */

$this->title = Yii::t('app', 'Create Activity');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Activities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-create card material-card">
    <div class="card-header">
        <h3><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="card-body">    <?= $this->render('_form', [
            'model' => $model,
            'assignment'=>$assignment,
        ]) ?>
    </div>
</div>