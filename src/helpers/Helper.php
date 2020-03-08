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
     * String constant used in the `redirect` GET variable of a URL to indicate
     * that we want to save the model and coninue. In Create actions it will 
     * redirect to update and in Update actions it will refresh
     * @see \bvb\crud\actions\Create
     * @see \bvb\crud\actions\Update
     * @var string
     */
    const SAVE_AND_CONTINUE = 'save-and-continue';

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