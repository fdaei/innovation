<?php

use backend\models\User;
use backend\modules\changeLog\models\ChangeLog;
use common\models\Contact;
use common\models\ContactCategory;
use common\models\mongo\MGMediaOperations;
use common\models\mongo\OrderFeedback;
use common\models\mongo\ProductFeedback;
use common\models\Order;
use common\models\Package;
use common\models\PackageOut;
use common\models\Product;
use common\models\SurveyProduct;
use common\models\UnfairPricing;
use mobit\comment\models\Comment;
use yii\caching\TagDependency;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Pjax;

/* @var $this View */

$this->title = "پنل مدیریت مبیت";
$this->params['breadcrumbs'][] = $this->title;
?>
<?php Pjax::begin(['id' => 'p-jax-index', 'timeout' => false]); ?>
<!--state overview start-->
<?php if (empty(Yii::$app->user->identity->email)) : ?>
<div class="card">
    <div class="card-body">
        <div class="row state-overview">
            <div class="col-md-12">
                    <div class="alert alert-danger">
                        <p>لطفا آدرس ایمیل خود را ثبت نمایید</p>
                        <p>
                            <?= Html::a(Yii::t('app', 'Create'),
                                'javascript:void(0)', [
                                    'title' => Yii::t('app', 'Create'),
                                    'id' => 'create-payment-period',
                                    'class' => 'btn btn-primary',
                                    'data-size' => 'modal-lg',
                                    'data-title' => Yii::t('app', 'Create'),
                                    'data-toggle' => 'modal',
                                    'data-target' => '#modal-pjax',
                                    'data-url' => Url::to(['/profile/set-email']),
                                    'data-reload-pjax-container-on-show' => 0,
                                    'data-reload-pjax-container' => 'p-jax-index',
                                    'data-handleFormSubmit' => 1,
                                    'disabled' => true
                                ]); ?>
                        </p>
                    </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if ($this->beginCache('cachedReports', ['duration' => 12 * 3600, 'dependency' => new TagDependency(['tags' => 'cachedReports-' . Yii::$app->user->id])])) { ?>
    <div class="d-flex justify-content-end card-header">
        <?= Html::a(Html::tag('span', '', ['class' => "far fa-history fa-2x text-danger ml-2"]), 'javascript:void(0)',
            [
                'title' => Yii::t('app', 'Refresh Cached Content'),
                'aria-label' => Yii::t('app', 'Refresh Cached Content'),
                'data-reload-pjax-container' => 'p-jax-index',
                'data-pjax' => '0',
                'data-url' => Url::to(['/system/purge', 'tags' => 'cachedReports-' . Yii::$app->user->id]),
                'class' => "p-jax-btn",
                'data-title' => Yii::t('app', 'Refresh Cached Content'),
                'data-toggle' => 'tooltip',
                'data-method' => 'POST'
            ]); ?>
    </div>
    <div class="row">
        <div class="col-lg-2 col-md-6">
            <div class="card border-bottom border-cyan">
                <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <h2><?= User::find()->andWhere(['<>', 'status', User::STATUS_DELETED])->count() ?></h2>
                            <h6 class="text-cyan"><?= Html::a('کاربران سایت', ['user/index'], ['class' => 'text-info']) ?></h6>
                        </div>
                        <div class="ml-auto">
                            <span class="text-cyan display-6"><i class="fal fa-user"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-6">
            <div class="card border-bottom border-success">
                <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <h2><?= Order::find()->byType(Order::TYPE_MBT)->byStatus(Order::STATUS_CONFIRM)->count(); ?></h2>
                            <h6 class="text-success"><?= Html::a('سفارشات تایید شده', ['/orders/order/index', 'OrderNewSearch[status]' => Order::STATUS_CONFIRM], ['class' => 'text-success']) ?></h6>
                        </div>
                        <div class="ml-auto">
                            <span class="text-success display-6"><i class="fal fa-tags"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-6">
            <div class="card border-bottom border-danger">
                <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <h2><?= Order::find()->byType(Order::TYPE_MBT)->byStatus(Order::STATUS_ANALYSING)->count(); ?></h2>
                            <h6 class="text-danger"><?= Html::a('سفارشات جدید', ['/orders/order/index', 'OrderNewSearch[status]' => Order::STATUS_ANALYSING], ['class' => 'text-danger']) ?></h6>
                        </div>
                        <div class="ml-auto">
                            <span class="text-danger display-6"><i class="fal fa-shopping-cart"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-6">
            <div class="card border-bottom border-warning">
                <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <h2><?= Order::find()->byType(Order::TYPE_MBT)->andWhere(['date' => Yii::$app->jdate->date("Y/m/d")])->count(); ?></h2>
                            <h6 class="text-warning"><?= Html::a('سفارشات امروز', ['/orders/order/index', 'OrderNewSearch[created_from]' => Yii::$app->jdate->date("Y/m/d")], ['class' => 'text-warning']) ?></h6>
                        </div>
                        <div class="ml-auto">
                            <span class="text-warning display-6"><i class="fal fa-shopping-cart"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-6">
            <div class="card border-bottom border-primary">
                <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <h2><?= Package::find()->byStatus(Package::STATUS_READY_FOR_DELIVER_OR_SEND)->count(); ?></h2>
                            <h6 class="text-primary"><?= Html::a(Yii::t('app', 'Product Packages'), ['/orders/package/index'], ['class' => 'text-primary']) ?></h6>
                        </div>
                        <div class="ml-auto">
                            <span class="text-primary display-6"><i class="fal fa-hand-holding-box"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-6">
            <div class="card border-bottom border-inverse">
                <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <h2><?= PackageOut::find()->byStatus(PackageOut::STATUS_READY_FOR_DELIVER_OR_SEND)->count(); ?></h2>
                            <h6 class="text-inverse font-10"><?= Html::a(Yii::t('app', 'Product Packages Out'), ['/orders/package-out/index'], ['class' => 'text-inverse']) ?></h6>
                        </div>
                        <div class="ml-auto">
                            <span class="text-inverse display-6"><i class="fal fa-truck-loading"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-6">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <a class="accordion-toggle collapsed" data-toggle="collapse"
                           data-parent="#accordion"
                           href="#collapseReport" aria-expanded="false">
                            <div class="p-3 border-bottom">
                                <div class="d-flex align-items-center">

                                    <h5 class="card-title text-uppercase">گزارشات</h5>
                                    <span class="ml-auto card-title">
                    <i class="fal fa-clipboard-list fa-2x"></i>
                </span>
                                </div>
                            </div>
                        </a>
                        <div id="collapseReport" class="panel-collapse collapse" aria-expanded="false">
                            <div class="card-body bg-light">
                                <div class="feed-widget">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <ul class="feed-body list-style-none">
                                                <li class="feed-item d-flex align-items-center py-2">
                                    <span class="badge badge-info badge-circle">
                                        <i class="far fa-ballot-check text-white"></i>
                                    </span>
                                                    <?= Html::a('پرفروش ترین محصولات', ['/report/best-seller-product'], ['class' => "ml-3 font-light", 'target' => '_blank']) ?>
                                                </li>
                                                <li class="feed-item d-flex align-items-center py-2">
                                    <span class="badge badge-info badge-circle">
                                        <i class="far fa-ballot-check text-white"></i>
                                    </span>
                                                    <?= Html::a('پرفروش ترین تنوع محصولات', ['/report/best-seller-variety'], ['class' => "ml-3 font-light", 'target' => '_blank']); ?>
                                                </li>
                                                <li class="feed-item d-flex align-items-center py-2">
                                    <span class="badge badge-info badge-circle">
                                        <i class="far fa-ballot-check text-white"></i>
                                    </span>
                                                    <?= Html::a('بیشترین خرید', ['/report/best-seller-customer'], ['class' => "ml-3 font-light", 'target' => '_blank']); ?>
                                                </li>
                                                <li class="feed-item d-flex align-items-center py-2">
                                    <span class="badge badge-info badge-circle">
                                        <i class="far fa-ballot-check text-white"></i>
                                    </span>
                                                    <?= Html::a('گزارش فروش روزانه هر ماه', ['/report/sell-in-month'], ['class' => "ml-3 font-light", 'target' => '_blank']); ?>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-6">
                                            <ul class="feed-body list-style-none">
                                                <li class="feed-item d-flex align-items-center py-2">
                                    <span class="badge badge-info badge-circle">
                                        <i class="far fa-ballot-check text-white"></i>
                                    </span>
                                                    <?= Html::a('گزارش ثبت نام روزانه هر ماه', ['/report/register-in-month'], ['class' => "ml-3 font-light", 'target' => '_blank']); ?>
                                                </li>
                                                <li class="feed-item d-flex align-items-center py-2">
                                    <span class="badge badge-info badge-circle">
                                        <i class="far fa-ballot-check text-white"></i>
                                    </span>
                                                    <?= Html::a('گزارش بالانس مالی', ['/report/balance'], ['class' => "ml-3 font-light", 'target' => '_blank']); ?>
                                                </li>
                                                <li class="feed-item d-flex align-items-center py-2">
                                    <span class="badge badge-info badge-circle">
                                        <i class="far fa-ballot-check text-white"></i>
                                    </span>
                                                    <?= Html::a('گزارش کد ملی تکراری', ['/report/user-duplicate'], ['class' => "ml-3 font-light", 'target' => '_blank']); ?>
                                                </li>
                                                <li class="feed-item d-flex align-items-center py-2">
                                    <span class="badge badge-info badge-circle">
                                        <i class="far fa-ballot-check text-white"></i>
                                    </span>
                                                    <?= Html::a('موجودی رزرو', ['/product-reservation/index'], ['class' => "ml-3 font-light", 'target' => '_blank']); ?>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-6">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <a href="<?= Url::to(['/orders/question/index']) ?>">
                        <div class="card bg-info">
                            <div class="card-body">
                                <div class="d-flex no-block align-items-center">
                                    <div class="text-white">
                                        <h2><?= Comment::find()
                                                ->specificClass(Product::class)
                                                ->questions()
                                                ->draft()
                                                ->count() . ' پرسش ' ?>
                                            / <?= Comment::find()
                                                ->joinWith(['parent parentComment'])
                                                ->andWhere("parentComment.status=" . Comment::PUBLISHED)
                                                ->specificClass(Product::class)
                                                ->replies()
                                                ->draft()
                                                ->count() . ' پاسخ ' ?>
                                        </h2>
                                        <h6>پرسش ها و پاسخ های در انتظار تایید</h6>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="text-white display-6"><i class="fal fa-question-square"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6 col-md-6">
                    <a href="<?= Url::to(['/orders/survey-product/index']) ?>">
                        <div class="card bg-success">
                            <div class="card-body">
                                <div class="d-flex no-block align-items-center">
                                    <div class="text-white">
                                        <h2>
                                            <?= SurveyProduct::find()->waitForActive()->count() . ' ' . 'نظر' ?>/
                                            <?= MGMediaOperations::find()->pendingComment()->count() . ' ' . 'نظر روی ویدئوها' ?>
                                        </h2>
                                        <h6>نظرات در انتظار تایید</h6>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="text-white display-6"><i class="far fa-comment-alt"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6 col-md-6">
                    <a href="<?= Url::to(['/orders/contact/index']) ?>">
                        <div class="card bg-primary">
                            <div class="card-body">
                                <div class="d-flex no-block align-items-center">
                                    <div class="text-white">
                                        <h2>
                                            <?php
                                            $userRoles = Yii::$app->user->identity->getRoleName(true);
                                            $like_conditions[0] = 'OR';
                                            $like_conditions[] = ['in', ContactCategory::tableName() . '.access_roles', [null, '']];
                                            foreach ($userRoles as $role) {
                                                $like_conditions[] = ['like', ContactCategory::tableName() . '.access_roles', $role];
                                            }

                                            $query = Contact::find()
                                                ->joinWith(['contactCategory'], false)
                                                ->andWhere(['and', $like_conditions])
                                                ->andWhere([Contact::tableName() . '.status' => Contact::STATUS_INACTIVE]);

                                            echo $query->count();
                                            ?>
                                        </h2>
                                        <h6>تماس با ما پیگیری نشده</h6>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="text-white display-6"><i class="far fa-headphones"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6 col-md-6">
                    <a href="<?= Url::to(['/orders/unfair-pricing/index']) ?>">
                        <div class="card bg-warning">
                            <div class="card-body">
                                <div class="d-flex no-block align-items-center">
                                    <div class="text-white">
                                        <h2><?= UnfairPricing::find()->unread()->count() ?></h2>
                                        <h6><?= Yii::t('app', 'Unfair Pricing Reports') ?></h6>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="text-white display-6"><i class="far fa-money-bill-alt"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6 col-md-6">
                    <a href="<?= Url::to(['/orders/order-feedback/index']) ?>">
                        <div class="card bg-cyan">
                            <div class="card-body">
                                <div class="d-flex no-block align-items-center">
                                    <div class="text-white">
                                        <h2><?= OrderFeedback::find()->unread()->count() ?></h2>
                                        <h6><?= Yii::t('app', 'Order Feedback') ?></h6>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="text-white display-6"><i class="far fa-shopping-bag"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6 col-md-6">
                    <a href="<?= Url::to(['/orders/product-feedback/index']) ?>">
                        <div class="card bg-danger">
                            <div class="card-body">
                                <div class="d-flex no-block align-items-center">
                                    <div class="text-white">
                                        <h2><?= ProductFeedback::find()->unread()->count() ?></h2>
                                        <h6><?= Yii::t('app', 'Product Feedback') ?></h6>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="text-white display-6"><i class="far fa-box-full"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php $this->endCache();
} ?>
<?php Pjax::end(); ?>
