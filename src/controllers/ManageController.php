<?php

namespace bvb\crud\controllers;

use bvb\crud\actions\Manage;
use ReflectionClass;
use yii\web\Controller;
use yii\helpers\Html;

/**
 * ManageController implements only the Manage action of the CRUD actions
 * and uses the key 'index' to reach it. This is useful for when we are creating
 * modules and want to have URLs that aren't repeating the module name in them
 * or or using DefaultController and then making special URL rules to keep them
 * pretty
 */
class ManageController extends Controller
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
     * Uses the Manage action class at the 'index' route. Sets toolbar button to create new model at CreateController
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'index' => [
                'class' => Manage::class,
                'modelClass' =>  $this->modelClass,
                'searchModelClass' => $this->searchModelClass,
                'toolbarWidgets' => [
                    Html::a('New '.((new ReflectionClass($this->modelClass))->getShortName()), ['create/'], ['class' => 'btn btn-success'])
                ]
            ]
        ];
    }
}
