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
     * @return string The class shortname in a readable format
     */
    static function getShortName($class)
    {
        return (new ReflectionClass($class))->getShortName();
    }

    /**
     * Namespaced full path to a default search model class which will be
     * {$classNameSpace}\search\{$classShortName}Search
     * @return string 
     */
    static function getDefaultSearchModelClass($class)
    {
        $reflect = new ReflectionClass($class);
        return $reflect->getNameSpaceName().'\search\\'.$reflect->getShortName().'Search';
    }
}