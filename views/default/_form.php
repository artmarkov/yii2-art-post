<?php

use artsoft\helpers\Html;
use artsoft\media\widgets\TinyMce;
use artsoft\models\User;
use artsoft\post\models\Category;
use artsoft\post\models\Post;
use artsoft\widgets\ActiveForm;
use artsoft\widgets\LanguagePills;
use kartik\date\DatePicker;
use artsoft\post\models\Tag;

/* @var $this yii\web\View */
/* @var $model artsoft\post\models\Post */
/* @var $form artsoft\widgets\ActiveForm */
?>

    <div class="post-form">

        <?php
        $form = ActiveForm::begin([
            'id' => 'post-form',
            'validateOnBlur' => false,
        ])
        ?>

        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-8">

                        <?php if ($model->isMultilingual()): ?>
                            <?= LanguagePills::widget() ?>
                        <?php endif; ?>

                        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'content')->widget(TinyMce::className()); ?>

                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'tag_list')->widget(nex\chosen\Chosen::className(), [
                            'items' => Tag::getTags(),
                            'multiple' => true,
                            'translateCategory' => 'art/post',
                            'placeholder' => Yii::t('art/post', 'Select Tags...'),
                        ])
                        ?>

                        <?= $form->field($model, 'category_id')->dropDownList(Category::getCategories(), ['prompt' => '', 'encodeSpaces' => true]) ?>

                        <?= $form->field($model, 'published_time')->widget(DatePicker::classname())->textInput(['autocomplete' => 'off']); ?>

                        <?= $form->field($model, 'status')->dropDownList(Post::getStatusList()) ?>

                        <?php if (!$model->isNewRecord && User::hasPermission('viewUsers')): ?>
                            <?= $form->field($model, 'created_by')->dropDownList(User::getUsersList()) ?>
                        <?php endif; ?>

                        <?= $form->field($model, 'comment_status')->dropDownList(Post::getCommentStatusList()) ?>

                        <?= $form->field($model, 'view')->dropDownList($this->context->module->viewList) ?>

                        <?= $form->field($model, 'layout')->dropDownList($this->context->module->layoutList) ?>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php if (!$model->isNewRecord) : ?>
                                            <?= \artsoft\mediamanager\widgets\MediaManagerWidget::widget(['model' => $model]); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="form-group">
                    <?= Html::a(Yii::t('art', 'Go to list'), ['/post/default/index'], ['class' => 'btn btn-default']) ?>
                    <?= Html::submitButton(Yii::t('art', 'Save'), ['class' => 'btn btn-primary']) ?>
                    <?php if (!$model->isNewRecord): ?>
                        <?= Html::a(Yii::t('art', 'Delete'), ['/post/default/delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                            ],
                        ]) ?>
                    <?php endif; ?>
                </div>
                <?= \artsoft\widgets\InfoModel::widget(['model'=>$model]); ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
<?php
$css = <<<CSS
.ms-ctn .ms-sel-ctn {
    margin-left: -6px;
    margin-top: -2px;
}
.ms-ctn .ms-sel-item {
    color: #666;
    font-size: 14px;
    cursor: default;
    border: 1px solid #ccc;
}
CSS;

$js = <<<JS
    var thumbnail = $("#post-thumbnail").val();
    if(thumbnail.length == 0){
        $('.post-thumbnail').hide();
    } else {
        $('.post-thumbnail').html('<img src="' + thumbnail + '" />');
    }
JS;

$this->registerCss($css);
$this->registerJs($js, yii\web\View::POS_READY);
?>