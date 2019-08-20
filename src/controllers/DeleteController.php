<?php

namespace bvb\crud\controllers;

use bvb\crud\actions\Delete;
use yii\web\Controller;

/**
 * DeleteController implements only the Delete action of the CRUD actions
 * and uses the key 'index' to reach it. This is useful for when we are creating
 * modules and want to have URLs that aren't repeating the module name in them
 * or or using DefaultController and then making special URL rules to keep them
 * pretty
 */
class DeleteController extends Controller
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
                'class' => Delete::class,
                'modelClass' =>  $this->modelClass,
                'redirect' => ['manage/index']
            ]
        ];
    }
}
