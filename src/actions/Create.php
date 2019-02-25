<?php

namespace bvb\crud\actions;

use kartik\form\ActiveForm;
use Yii;
use yii\helpers\Html;

/**
 * Create is for creating models
 */
class Create extends Action
{
	/**
	 * Configuration for a form that this action will set as a view parameter
	 * to be wrapped around the rendered view
	 */
	public $formConfig = [
		'class' => ActiveForm::class
	];

	/**
	 * @var array Default values to be used when constructing a new model
	 */
	public $modelDefaults = [];

	/**
	 * @var string The name of the file to be rendered for the view
	 */
	public $view = 'create';

	/**
	 * @var mixed The name of the file to be rendered for the view
	 */
	public $redirect = ['index']; // --- Defaults to the Manage action in the ActiveController

    /**
     * Will set the toolbar buttons with a Submit button
     * Set the default title for the view to be 'Create [[modelClass]]''
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        Yii::$app->view->title = 'Create '.$this->getShortName();

        if(!empty($this->formConfig)){
            Yii::$app->view->form = Yii::createObject($this->formConfig);
        }
        Yii::$app->view->toolbar['buttons'] = Html::submitButton('Save', ['class' => 'btn btn-success']);
    }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'manage' page.
	 * @return mixed
	 */
	public function run()
	{
		if ($this->checkAccess) {
			call_user_func($this->checkAccess, $this->id);
		}

		$model = new $this->modelClass($this->modelDefaults);

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			Yii::$app->session->addFlash('success', $this->getShortName().' created.');
			return $this->controller->redirect($this->redirect);
		} else {
			return $this->controller->render($this->view, [
				'model' => $model,
			]);
		}
	}
}
