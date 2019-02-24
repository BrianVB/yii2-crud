<?php

namespace bvb\crud\controllers;

use bvb\crud\actions\Update;
use yii\base\Controller;

/**
 * UpdateController implements only the Update action of the CRUD actions
 * and uses the key 'index' to reach it. This is useful for when we are creating
 * modules and want to have URLs that aren't repeating the module name in them
 * or or using DefaultController and then making special URL rules to keep them
 * pretty
 */
class UpdateController extends Controller
{
    /**
     * @var string the model class name. This property must be set.
     */
    public $modelClass;

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'index' => [
                'class' => Update::class,
                'modelClass' =>  $this->modelClass,
            ]
        ];
    }
}
