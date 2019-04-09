<?php

use artsoft\helpers\Html;
use yii\helpers\Url;
use artsoft\grid\GridPageSize;
use yii\widgets\Pjax;
use artsoft\grid\SortableGridView;
use artsoft\post\models\Category;

/* @var $this yii\web\View */
/* @var $searchModel artsoft\post\search\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('art/post', 'Categories');
$this->params['breadcrumbs'][] = ['label' => Yii::t('art/post', 'Posts'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="post-category-index">

    <div class="row">
        <div class="col-sm-12">
            <h3 class="lte-hide-title page-title"><?= Html::encode($this->title) ?></h3>
            <?= Html::a(Yii::t('art', 'Add New'), ['/post/category/create'], ['class' => 'btn btn-sm btn-primary']) ?>
        </div>
    </div>

   <div class="panel panel-default">
        <div class="panel-body">

            <div class="row">
                <div class="col-sm-12 text-right">
                    <?= GridPageSize::widget(['pjaxId' => 'post-category-grid-pjax']) ?>
                </div>
            </div>

            <?php Pjax::begin(['id' => 'post-category-grid-pjax']) ?>

            <?= SortableGridView::widget([
                'id' => 'post-category-grid',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'sortableAction' => ['grid-sort'],
                'bulkActionOptions' => [
                    'gridId' => 'post-category-grid',
                    'actions' => [Url::to(['bulk-delete']) => Yii::t('art', 'Delete')]
                ],
                'columns' => [
                    ['class' => 'artsoft\grid\CheckboxColumn', 'options' => ['style' => 'width:10px']],
                    [
                        'class' => 'artsoft\grid\columns\TitleActionColumn',
                        'controller' => '/post/category',
                        'title' => function (Category $model) {
                            return Html::encode($model->title);
                        },
                        'buttonsTemplate' => '{update} {delete}',
                    ],
                    'description:ntext',
                    [
                        'class' => 'artsoft\grid\columns\StatusColumn',
                        'attribute' => 'visible',
                    ],
                ],
            ]); ?>

            <?php Pjax::end() ?>
        </div>
    </div>
</div>