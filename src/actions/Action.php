<?php

namespace bvb\crud\actions;

use ReflectionClass;
use yii\base\InvalidConfigException;

/**
 * CrudAction is a base class for Create, Read (view), Update, Delete actions to extend
 * from. This extends from [[\yii\rest\Action]] because that class actually implements 
 * everything we need without necessarily having to be used for REST calls 
 */
class Action extends \yii\rest\Action
{
    /**
     * Returns the model classes shortname in a readable format
     * @return string
     */
    protected function getShortName()
    {
        $reflect = new ReflectionClass($this->modelClass);
        return $reflect->getShortName();
    }
}
