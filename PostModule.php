<?php

/**
 * @link http://www.yee-soft.com/
 * @copyright Copyright (c) 2015 Taras Makitra
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */

namespace artsoft\post;

use Yii;

/**
 * Post Module For Art CMS
 *
 * @author Taras Makitra <makitrataras@gmail.com>
 */
class PostModule extends \yii\base\Module
{

    /**
     * Version number of the module.
     */
    const VERSION = '0.1.0';

    public $controllerNamespace = 'artsoft\post\controllers';
    public $viewList;
    public $layoutList;

    /**
     * Post model class
     *
     * @var string
     */
    public $postModelClass = 'artsoft\post\models\Post';

    /**
     * Post search model class
     *
     * @var string
     */
    public $postModelSearchClass = 'artsoft\post\models\search\PostSearch';

    /**
     * Index page view
     *
     * @var string
     */
    public $indexView = 'index';

    /**
     * View page view
     *
     * @var string
     */
    public $viewView = 'view';

    /**
     * Create page view
     *
     * @var string
     */
    public $createView = 'create';

    /**
     * Update page view
     *
     * @var string
     */
    public $updateView = 'update';

    /**
     * Tag model class
     *
     * @var string
     */
    public $tagModelClass = 'artsoft\post\models\Tag';

    /**
     * Tag search model class
     *
     * @var string
     */
    public $tagModelSearchClass = 'artsoft\post\models\search\TagSearch';

    /**
     * Index tag view
     *
     * @var string
     */
    public $tagIndexView = 'index';

    /**
     * View tag view
     *
     * @var string
     */
    public $tagViewView = 'view';

    /**
     * Create tag view
     *
     * @var string
     */
    public $tagCreateView = 'create';

    /**
     * Update tag view
     *
     * @var string
     */
    public $tagUpdateView = 'update';

    /**
     * Category model class
     *
     * @var string
     */
    public $categoryModelClass = 'artsoft\post\models\Category';

    /**
     * Category search model class
     *
     * @var string
     */
    public $categoryModelSearchClass = 'artsoft\post\models\search\CategorySearch';

    /**
     * Index category view
     *
     * @var string
     */
    public $categoryIndexView = 'index';

    /**
     * View category view
     *
     * @var string
     */
    public $categoryViewView = 'view';

    /**
     * Create category view
     *
     * @var string
     */
    public $categoryCreateView = 'create';

    /**
     * Update category view
     *
     * @var string
     */
    public $categoryUpdateView = 'update';

    /**
     * Size of thumbnail image of the post.
     *
     * Expected values: 'original' or sizes from artsoft\media\MediaModule::$thumbs,
     * by default there are: 'small', 'medium', 'large'
     *
     * @var string
     */
    public $thumbnailSize = 'medium';

    /**
     * Default views and layouts
     * Add more views and layouts in your main config file by calling the module
     *
     *   Example:
     *
     *   'post' => [
     *       'class' => 'artsoft\post\PostModule',
     *       'viewList' => [
     *           'post' => 'View Label 1',
     *           'post_test' => 'View Label 2',
     *       ],
     *       'layoutList' => [
     *           'main' => 'Layout Label 1',
     *           'dark_layout' => 'Layout Label 2',
     *       ],
     *   ],
     */
    public function init()
    {
        if (in_array($this->thumbnailSize, [])) {
            $this->thumbnailSize = 'medium';
        }

        if (empty($this->viewList)) {
            $this->viewList = [
                'post' => Yii::t('art', 'Post view')
            ];
        }

        if (empty($this->layoutList)) {
            $this->layoutList = [
                'main' => Yii::t('art', 'Main layout')
            ];
        }

        parent::init();
    }

}
