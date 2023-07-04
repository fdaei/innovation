<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Freelancer;
use common\models\FreelancerPortfolio;
/** @var yii\web\View $this */
/** @var common\models\Freelancer $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Freelancers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-leave-view">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="panel-title mt-2">
                <?= Html::encode($this->title) ?>
            </h4>
            <div>
                <?= Html::a(Yii::t('app','Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <div class="card-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    [
                        'attribute' => 'header_picture_desktop',
                        'value' => $model->getUploadUrl('header_picture_desktop'),
                        'format' => ['image',['width'=>'100','height'=>'100']],
                    ],
                    [
                        'attribute' => 'header_picture_mobile',
                        'value' => $model->getUploadUrl('header_picture_mobile'),
                        'format' => ['image',['width'=>'100','height'=>'100']],
                    ],
                    [
                        'attribute' => 'freelancer_picture',
                        'value' => $model->getUploadUrl('freelancer_picture'),
                        'format' => ['image',['width'=>'100','height'=>'100']],
                    ],
                    'name',
                    [
                        'attribute' => 'sex',
                        'value' => Freelancer::itemAlias('Sex',$model->sex)
                    ],
                    'email:email',
                    'mobile',
                    [
                        'attribute' => 'province',
                        'value' => $model->getProvince()?->name,
                    ],
                    [
                        'attribute' => 'city',
                        'value' => $model->getCity()?->name,
                    ],
                    [
                        'attribute' => 'marital_status',
                        'value' => Freelancer::itemAlias('Marital',$model->sex)
                    ],
                    [
                        'attribute' => 'military_service_status',
                        'value' => Freelancer::itemAlias('Military',$model->sex)
                    ],
                    'activity_field',
                    [
                        'attribute' => 'experience',
                        'label' => 'میزان تجربه',
                        'value' => Freelancer::itemAlias('Experience',$model->experience),
                    ],
                    'experience_period',
                    [
                        'attribute' => 'skills',
                        'value' => function ($data) {
                            $str = '';
                            foreach ($data->skills as $item){
                                $str .= $item['title'].' , ';
                            }
                            return $str;
                        },
                    ],
                    [
                        'attribute' => 'record_job',
                        'value' => function ($data) {
                            $str = '';
                            foreach ($data->record_job as $item){
                                $str .= $item['title'].' , ';
                            }
                            return $str;
                        },
                    ],
                    [
                        'attribute' => 'record_educational',
                        'value' => function ($data) {
                            $str = '';
                            foreach ($data->record_educational as $item){
                                $str .= $item['title'].' , ';
                            }
                            return $str;
                        },
                    ],
                    [
                        'attribute' => 'portfolio',
                        'value' => function ($data) {
                            $str = '';
                            $portfolio = FreelancerPortfolio::find()->andWhere(['freelancer_id' => $data->id])->all();
                            foreach ($portfolio as $item){
                                $str .= $item['title'].' , ';
                            }
                            return $str;
                        },
                    ],
                    [
                        'attribute' => 'resume_file',
                        'format'=>'raw',
                        'value'=> $model->resume_file ? Html::a(Yii::t('app', 'Download the File'), $model->getUploadUrl('resume_file')): '---',
                    ],
                    'freelancer_description:ntext',
                    'description_user:ntext',
                    'project_number',
                    [
                        'label' => 'وضعیت',
                        'value' =>Freelancer::itemAlias('Status',$model->status),
                    ],

                ],
            ]) ?>

        </div>
    </div>
</div>