<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\MentorServices $model */

$this->title = Yii::t('app', 'Create Mentor Services');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mentor Services'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mentor-services-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
