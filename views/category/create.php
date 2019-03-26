<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model artsoft\post\models\Category */

$this->title = Yii::t('art/post', 'Create Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('art/post', 'Posts'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('art/post', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('art', 'Create');
?>

<div class="post-category-create">
    <h3 class="lte-hide-title"><?= Html::encode($this->title) ?></h3>
    <?= $this->render('_form', compact('model')) ?>
</div>