<?php

use common\models\Business;
use common\models\BusinessGallery;
use common\models\BusinessMember;
use common\models\BusinessStat;
use common\models\BusinessTimeline;
use common\models\BusinessTimelineItem;
use yii\bootstrap4\Tabs;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/** @var View $this */
/** @var Business $model */
/** @var BusinessGallery $gallery */
/** @var BusinessMember $members */
/** @var BusinessTimeline $timeline */
/** @var BusinessStat $stat */
/** @var BusinessTimelineItem $timelineitems */


$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Businesses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card material-card">
    <div class="card-body">
        <?php $this->beginBlock('Business'); ?>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'user_id',
                'city_id',
                'title',
                'slug',
                'link',
                [
                    'attribute' => 'logo',
                    'value' => Html::img($model->getUploadUrl('logo')),
                    'format' => 'raw'
                ],
                [
                    'attribute' => 'wallpaper',
                    'value' => Html::img($model->getUploadUrl('wallpaper')),
                    'format' => 'raw'
                ],
                [
                    'attribute' => 'mobile_wallpaper',
                    'value' => Html::img($model->getUploadUrl('mobile_wallpaper')),
                    'format' => 'raw'
                ],
                'investor_description',
                'short_description:ntext',
                'success_story:ntext',
                'status',
            ],
        ]) ?>
        <?php $this->endBlock(); ?>

        <?php $this->beginBlock('Galleries'); ?>
        <?php foreach ($gallery as $i => $item): ?>
            <?=
            DetailView::widget([
                'model' => $item,
                'attributes' => [
                    'image',
                    'mobile_image',
                    'title',
                    'description:ntext',
                    'status',
                ],
            ]);
            ?>
        <?php endforeach; ?>
        <?php $this->endBlock(); ?>

        <?php $this->beginBlock('Members'); ?>
        <?php foreach ($members as $i => $item): ?>
            <?=
            DetailView::widget([
                'model' => $item,
                'attributes' => [
                    'first_name',
                    'last_name',
                    'image',
                    'position',
                    'status',
                ],
            ]);
            ?>
        <?php endforeach; ?>
        <?php $this->endBlock(); ?>

        <?php $this->beginBlock('Stat'); ?>
        <?php foreach ($stat as $i => $item): ?>
            <?=
            DetailView::widget([
                'model' => $item,
                'attributes' => [
                    'type',
                    'title',
                    'subtitle',
                    'icon',
                    'status',
                ],
            ]);
            ?>
        <?php endforeach; ?>
        <?php $this->endBlock(); ?>

        <?php $this->beginBlock('TimelineItems'); ?>
        <?php foreach ($timelineitems as $i => $item): ?>
            <?=
            DetailView::widget([
                'model' => $item,
                'attributes' => [
                    'id',
                    'business_timeline_id',
                    'description:ntext',
                    'status',
                ],
            ]);
            ?>
        <?php endforeach; ?>
        <?php $this->endBlock(); ?>

        <?php $this->beginBlock('Timeline'); ?>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <section class="cd-horizontal-timeline">
                            <div class="timeline">
                                <div class="events-wrapper">
                                    <div class="events">
                                        <ol>
                                            <?php foreach ($timeline as $i => $item): ?>
                                                <li><a href="#0" data-date="<?= date("d/m/Y", $item->created_at) ?>" class="<?= $i == 0 ? 'selected' : '' ?>"><?= $item->year ?></a></li>
                                                <?php endforeach; ?>
                                        </ol>
                                        <span class="filling-line" aria-hidden="true"></span>
                                    </div>
                                    <!-- .events -->
                                </div>
                                <!-- .events-wrapper -->
                                <ul class="cd-timeline-navigation">
                                    <li><a href="#0" class="prev inactive">Prev</a></li>
                                    <li><a href="#0" class="next">Next</a></li>
                                </ul>
                                <!-- .cd-timeline-navigation -->
                            </div>
                            <!-- .timeline -->
                            <div class="events-content">
                                <ol>
                                    <li class="selected" data-date="16/01/2014">
                                        <div class="d-flex align-items-center">
                                            <div><img class="rounded-circle pull-left mr-3 mb-2" width="60" alt="user" src="../../assets/images/users/1.jpg"></div>
                                            <div>
                                                <h2> Horizontal Timeline</h2>
                                                <h6>January 16th, 2014</h6></div>
                                        </div>
                                        <p class="pt-3">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                        </p>
                                        <p>
                                            <button class="btn btn-rounded btn-outline-info mt-3">Read more</button>
                                        </p>
                                    </li>
                                    <li data-date="28/02/2014">
                                        <div class="d-flex align-items-center">
                                            <div><img class="rounded-circle pull-left mr-3 mb-2" width="60" alt="user2" src="../../assets/images/users/8.jpg"></div>
                                            <div>
                                                <h2> Horizontal Timeline</h2>
                                                <h6>January 16th, 2014</h6></div>
                                        </div>
                                        <p class="pt-3">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                        </p>
                                        <p class="pb-3">
                                            <button class="btn btn-rounded btn-outline-info mt-3">Read more</button>
                                        </p>
                                    </li>
                                    <li data-date="20/04/2014">
                                        <h2><img class="rounded-circle pull-left mr-3 mb-2" width="60" alt="user3" src="../../assets/images/users/7.jpg"> Horizontal Timeline<br/><small>March 20th, 2014</small></h2>
                                        <p class="mt-5">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                        </p>
                                        <p class="pb-3">
                                            <button class="btn btn-rounded btn-outline-info mt-3">Read more</button>
                                        </p>
                                    </li>
                                    <li data-date="20/05/2014">
                                        <h2><img class="rounded-circle pull-left mr-3 mb-2" width="60" alt="user4" src="../../assets/images/users/6.jpg"> Horizontal Timeline<br/><small>May 20th, 2014</small></h2>
                                        <p class="mt-5">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                        </p>
                                        <p class="pb-3">
                                            <button class="btn btn-rounded btn-outline-info mt-3">Read more</button>
                                        </p>
                                    </li>
                                    <li data-date="09/07/2014">
                                        <h2><img class="rounded-circle pull-left mr-3 mb-2" width="60" alt="user5" src="../../assets/images/users/5.jpg"> Horizontal Timeline<br/><small>July 9th, 2014</small></h2>
                                        <p class="mt-5">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                        </p>
                                        <p class="pb-3">
                                            <button class="btn btn-rounded btn-outline-info mt-3">Read more</button>
                                        </p>
                                    </li>
                                    <li data-date="30/08/2014">
                                        <h2><img class="rounded-circle pull-left mr-3 mb-2" width="60" alt="user6" src="../../assets/images/users/4.jpg"> Horizontal Timeline<br/><small>August 30th, 2014</small></h2>
                                        <p class="mt-5">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                        </p>
                                        <p class="pb-3">
                                            <button class="btn btn-rounded btn-outline-info mt-3">Read more</button>
                                        </p>
                                    </li>
                                    <li data-date="15/09/2014">
                                        <h2><img class="rounded-circle pull-left mr-3 mb-2" width="60" alt="user7" src="../../assets/images/users/3.jpg"> Horizontal Timeline<br/><small>September 15th, 2014</small></h2>
                                        <p class="mt-5">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                        </p>
                                        <p class="pb-3">
                                            <button class="btn btn-rounded btn-outline-info mt-3">Read more</button>
                                        </p>
                                    </li>
                                    <li data-date="01/11/2014">
                                        <h2><img class="rounded-circle pull-left mr-3 mb-2" width="60" alt="user8" src="../../assets/images/users/2.jpg"> Horizontal Timeline<br/><small>November 01st, 2014</small></h2>
                                        <p class="mt-5">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                        </p>
                                        <p>
                                            <button class="btn btn-rounded btn-outline-info mt-3">Read more</button>
                                        </p>
                                    </li>
                                    <li data-date="10/12/2014">
                                        <h2><img class="rounded-circle pull-left mr-3 mb-2" width="60" alt="user9" src="../../assets/images/users/1.jpg"> Horizontal Timeline<br/><small>December 10th, 2014</small></h2>
                                        <p class="mt-5">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                        </p>
                                        <p class="pb-3">
                                            <button class="btn btn-rounded btn-outline-info mt-3">Read more</button>
                                        </p>
                                    </li>
                                    <li data-date="19/01/2015">
                                        <h2>Event title here</h2>
                                        <em>January 19th, 2015</em>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                        </p>
                                    </li>
                                    <li data-date="03/03/2015">
                                        <h2>Event title here</h2>
                                        <em>March 3rd, 2015</em>
                                        <p class="pb-3">
                                            Lorem ipsum dolor dfsit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                        </p>
                                    </li>
                                </ol>
                            </div>
                            <!-- .events-content -->
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->endBlock(); ?>

        <?php echo Tabs::Widget([
            'items' => [
                [
                    'label' => 'Business',
                    'content' => $this->blocks['Business'],
                    'active' => true,
                ],
                [
                    'label' => 'Galleries',
                    'content' => $this->blocks['Galleries'],
                ],
                [
                    'label' => 'Members',
                    'content' => $this->blocks['Members'],
                ],
                [
                    'label' => 'Timeline',
                    'content' => $this->blocks['Timeline'],
                ],
                [
                    'label' => 'TimelineItems',
                    'content' => $this->blocks['TimelineItems'],
                ],
                [
                    'label' => 'Stat',
                    'content' => $this->blocks['Stat'],
                ],
            ]
        ]); ?>
    </div>
</div>