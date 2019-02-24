<?php

namespace bvb\crud\controllers;

use bvb\crud\actions\Create;
use yii\web\Controller;

/**
 * CreateController implements only the Create action of the CRUD actions
 * and uses the key 'index' to reach it. This is useful for when we are creating
 * modules and want to have URLs that aren't repeating the module name in them
 * or or using DefaultController and then making special URL rules to keep them
 * pretty
 */
class CreateController extends Controller
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
                'class' => Create::class,
                'modelClass' =>  $this->modelClass,
                'redirect' => ['manage/']
            ]
        ];
    }
}
