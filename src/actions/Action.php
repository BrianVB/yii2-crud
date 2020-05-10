<?php

namespace bvb\crud\actions;

use bvb\crud\helpers\Helper;
use Yii;

/**
 * Action is a base class for Create, Read (view), Update, Delete actions to extend
 * from. This extends from [[\yii\rest\Action]] because that class actually implements
 * the [[\yii\rest\Action::$modelClass]] variable with [[\yii\rest\Action::findModel()]]
 * [[\yii\rest\Action::$checkAccess]] abilities.
 */
class Action extends \yii\rest\Action
{
    /**
     * HTML of buttons to be rendered in the toolbar
     * @var string
     */
    public $toolbarWidgets;

	/**
	 * Set certain components of the view regularly tied into crud actions like
	 * toolbar buttons or titles
	 * {@inheritdoc}
	 */
	public function init()
	{
		parent::init();
		$this->setViewToolbarWidgets();
	}

	/**
	 * Sets the widgets for the view toolbar with the value of [[self::$toolbarWidgets]]
	 * or if left as null will attempt to render default widgets
	 * @return void
	 */
	protected function setViewToolbarWidgets()
	{ 
		if($this->toolbarWidgets === null){
			Yii::$app->view->toolbar['widgets'] = $this->getDefaultToolbarWidgets();
		} else {
			Yii::$app->view->toolbar['widgets'] = $this->toolbarWidgets;
		}
	}

	/**
	 * Meant to be overridden by subclasses to add buttons to the view toolbar
	 * @return string
	 */
	protected function getDefaultToolbarWidgets()
	{
		return [];
	}

	/**
	 * @return string Readable name for [[self::$modelClass]]
	 */
    protected function getModelShortName()
    {
    	return Helper::getShortName($this->modelClass);
    }
}
