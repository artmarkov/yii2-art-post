<?php

namespace artsoft\post\widgets\dashboard;

use artsoft\models\User;
use artsoft\post\models\Post;
use artsoft\post\models\search\PostSearch;
use artsoft\widgets\DashboardWidget;
use Yii;

class Posts extends DashboardWidget
{
    /**
     * Most recent post limit
     */
    public $recentLimit = 5;

    /**
     * Post index action
     */
    public $indexAction = 'post/default/index';

    /**
     * Total post options
     *
     * @var array
     */
    public $options;

    public function run()
    {
        if (!$this->options) {
            $this->options = $this->getDefaultOptions();
        }

        if (User::hasPermission('viewPosts')) {
            $searchModel = new PostSearch();
            $formName = $searchModel->formName();

            $recentPosts = Post::find()->orderBy(['id' => SORT_DESC])->limit($this->recentLimit)->all();

            foreach ($this->options as &$option) {
                $count = Post::find()->filterWhere($option['filterWhere'])->count();
                $option['count'] = $count;
                $option['url'] = [$this->indexAction, $formName => $option['filterWhere']];
            }

            return $this->render('posts', [
                'height' => $this->height,
                'width' => $this->width,
                'position' => $this->position,
                'posts' => $this->options,
                'recentPosts' => $recentPosts,
            ]);
        }
    }

    public function getDefaultOptions()
    {
        return [
            ['label' => Yii::t('art', 'Published'), 'icon' => 'ok', 'filterWhere' => ['status' => Post::STATUS_PUBLISHED]],
            ['label' => Yii::t('art', 'Pending'), 'icon' => 'search', 'filterWhere' => ['status' => Post::STATUS_PENDING]],
        ];
    }
}