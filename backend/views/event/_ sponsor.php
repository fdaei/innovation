<div class="card card-body">
    <div class='col-md-12 ' style="">
        <div class="panel-body ">
            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper1', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items-sponsors', // required: css class selector
                'widgetItem' => '.item-sponsors', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item-sponsors', // css class
                'deleteButton' => '.remove-item-sponsors', // css class
                'model' => $eventSponsors[0],
                'formId' => 'event_form',
                'formFields' => [
                    'title',
                    'description'
                ],
            ]); ?>
            <div class="container-items-sponsors"><!-- widgetContainer -->
                <?php foreach ($eventSponsors as $i => $modelAddress): ?>
                    <div class="item-sponsors panel panel-default col-md-12" style="padding-right: 0px"><!-- widgetBody -->
                        <div class="panel-heading">
                            <div class="pull-right">
                                <button type="button" class="remove-item-sponsors btn btn-danger btn-xs">حذف</button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <?php
                            // necessary for update action.
                            if (! $modelAddress->isNewRecord) {
                                echo Html::activeHiddenInput($modelAddress, "[{$i}]id");
                            }
                            ?>
                            <div class="row">
                                <div class='col-sm-5'>
                                    <?= $form->field($modelAddress, "[{$i}]picture")->fileInput() ?>
                                </div>
                                <div class="col-sm-7">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <?= $form->field($modelAddress, "[{$i}]title")->textInput(['maxlength' => true]) ?>
                                        </div>
                                        <div class="col-sm-6">
                                            <?= $form->field($modelAddress, "[{$i}]description")->textarea(['maxlength' => true]) ?>
                                        </div>
                                        <div class="col-sm-6">
                                            <?= $form->field($modelAddress, "[{$i}]instagram")->textInput(['maxlength' => true]) ?>
                                        </div>
                                        <div class="col-sm-6">
                                            <?= $form->field($modelAddress, "[{$i}]telegram")->textarea(['maxlength' => true]) ?>
                                        </div>
                                        <div class="col-sm-6">
                                            <?= $form->field($modelAddress, "[{$i}]whatsapp")->textarea(['maxlength' => true]) ?>
                                        </div>
                                    </div>
                                </div>

                            </div><!-- .row -->
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <button type="button" class="add-item-sponsors btn btn-success btn-xs">حامی جدید</button>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>
</div>