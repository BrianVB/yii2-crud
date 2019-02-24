<?php

namespace bvb\crud\controllers;

use bvb\crud\actions\Create;
use bvb\crud\actions\Delete;
use bvb\crud\actions\Manage;
use bvb\crud\actions\Update;
use yii\web\Controller;

/**
 * ActiveController implements all of the CRUD actions for model.
 * This would probably be used when we aren't creating things in modules and
 * a single controller would have all actions
 */
class ActiveController extends Controller
{
    /**
     * @var string the model class name. This property must be set.
     */
    public $modelClass;

    /**
     * the search model class name. If this is left empty the Manage action will try to 
     * determine it by using the model class name appended with 'Search'
     * @var string 
     */
    public $searchModelClass;

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'create' => [
                'class' => Create::class,
                'modelClass' =>  $this->modelClass,
            ],
            'delete' => [
                'class' => Delete::class,
                'modelClass' =>  $this->modelClass,
            ],
            'index' => [
                'class' => Manage::class,
                'modelClass' =>  $this->modelClass,
                'searchModelClass' => $this->searchModelClass,
            ],
            'update' => [
                'class' => Update::class,
                'modelClass' =>  $this->modelClass,
            ]
        ];
    }
}
