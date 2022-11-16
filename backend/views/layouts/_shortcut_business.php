<?php

use kartik\select2\Select2;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\web\View;

/* @var $this View */
/* @var $base_url string */
?>
    <div class="row">
        <div class="col-md-12">
            <?= Select2::widget([
                'name' => 'shortcutBusiness',
                'id' => 'shortcutBusiness',
                'options' => [
                    'placeholder' => 'کسب و کار...',
                    'dir' => 'rtl',
                    'data-base-url' => $base_url
                ],
//               'value'=>['228'],
                'pluginOptions' => [
                    'allowClear' => true,
                    'minimumInputLength' => 3,
                    'language' => [
                        'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                    ],
                    'ajax' => [
                        'url' => Url::to(['/business/list']),
                        'dataType' => 'json',
                        'data' => new JsExpression('function(params) { return {q:params.term}; }'),
                    ],
                    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                    'templateResult' => new JsExpression('function(data) { return data.html; }'),
                    'templateSelection' => new JsExpression('function (data) { return data.text; }'),
                ],
            ]);
            ?>
        </div>
    </div>

<?php
$script = <<< JS
$('#shortcutBusiness').on('change', function(e) {
    e.preventDefault();
    var id=$(this).val().split("#")[0];
    var actionUrl=$(this).val().split("#")[2];
    var baseUrl=$(this).data('base-url');
    window.location.href = baseUrl+actionUrl+'?id='+id;
});
JS;
$this->registerJs($script);

?>