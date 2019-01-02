<?php

namespace bvb\crud\actions;

use ReflectionClass;
use yii\base\Action;
use yii\base\InvalidConfigException;

/**
 * CrudAction is a generic class implementing some of the
 * base properties necessary for CRUD actions
 */
abstract class CrudAction extends Action
{
    /**
     * The classname of the model that CRUD operations will be performed on
     */
    public $model_class;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        if(empty($this->model_class)){
            throw new InvalidConfigException('Classes extending from CrudAction must set a `model_class` property with the classname of the model that CRUD operations will be performed on');
        }
    }

    /**
     * Returns the model classes shortname in a readable format
     * @return string
     */
    protected function getShortName()
    {
        $reflect = new ReflectionClass($this->model_class);
        return $reflect->getShortName();
    }
}
