<?php

namespace bvb\crud\helpers;

use ReflectionClass;
use yii\helpers\Inflector;

/**
 * Helper contains functions used commonly throughout the CRUD actions 
 * and controllers
 */
class Helper
{
    /**
     * Returns the name of a class without the full namespace
     * @return string
     */
    protected function getShortName($class)
    {
        $reflect = new ReflectionClass($class);
        return $reflect->getShortName();
    }

    
}