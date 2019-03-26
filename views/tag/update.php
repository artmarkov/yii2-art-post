<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model artsoft\post\models\Tag */

$this->title = Yii::t('art/post', 'Update Tag');
$this->params['breadcrumbs'][] = ['label' => Yii::t('art/post', 'Posts'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('art/post', 'Tags'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('art', 'Update');
?>
<div class="post-tag-update">
    <h3 class="lte-hide-title"><?= Html::encode($this->title) ?></h3>
    <?= $this->render('_form', compact('model')) ?>
</div>