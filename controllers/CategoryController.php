<?php

namespace artsoft\post\controllers;

use himiklab\sortablegrid\SortableGridAction;
use artsoft\controllers\admin\BaseController;

/**
 * CategoryController implements the CRUD actions for artsoft\post\models\Category model.
 */
class CategoryController extends BaseController
{
    //public $disabledActions = ['view', 'bulk-activate', 'bulk-deactivate'];
    
    public function init()
    {
        $this->modelClass = $this->module->categoryModelClass;
        $this->modelSearchClass = $this->module->categoryModelSearchClass;
        $this->indexView = $this->module->categoryIndexView;
        $this->viewView = $this->module->categoryViewView;
        $this->createView = $this->module->categoryCreateView;
        $this->updateView = $this->module->categoryUpdateView;
        parent::init();
    }
    protected function getRedirectPage($action, $model = null)
    {
        switch ($action) {
            case 'update':
                return ['update', 'id' => $model->id];
                break;
            case 'create':
                return ['update', 'id' => $model->id];
                break;
            default:
                return parent::getRedirectPage($action, $model);
        }
    }
    
    /**
     * action sort for himiklab\sortablegrid\SortableGridBehavior
     * @return type
     */
    public function actions()
    {
        return [
            'sort' => [
                'class' => SortableGridAction::className(),
                'modelName' => $this->modelClass,
            ],
        ];
    }
}