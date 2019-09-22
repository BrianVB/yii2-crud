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
     * Returns the class shortname in a readable format
     */
    static function getShortName($class)
    {
        return (new ReflectionClass($class))->getShortName();
    }
}