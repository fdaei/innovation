<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Freelancer $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Freelancers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card-body card">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('ویرایش', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'header_picture_desktop',
            'header_picture_mobile',
            'freelancer_picture',
            'freelancer_description:ntext',
            'name',
            'sex',
            'email:email',
            'mobile',
            'city',
            'province',
            'marital_status',
            'military_service_status',
            'activity_field',
            'experience',
            'experience_period',
//            'skills',
            'record_job',
            'record_educational',
            'portfolio',
            'resume_file',
            'description_user:ntext',
            'project_number',
            [
                'label' => 'وضعیت',
                'value' =>\common\models\Freelancer::itemAlias('Status',$model->status)
            ],

        ],
    ]) ?>

</div>
