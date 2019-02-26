<?php

namespace bvb\crud\actions;

use kartik\form\ActiveForm;
use Yii;
use yii\helpers\Html;
use yii\helpers\Inflector;

/**
 * Create is for creating models
 */
class Create extends Action
{
	/**
	 * String constant to be recognized as a redirect to the page to update the 
	 * newly created model. This is required because the URL does not exist yet
	 * since the model hasn't been created so we need a way to recognize this
	 * is the behavior we want
	 * @var string
	 */
	const REDIRECT_TO_UPDATE = 'redirect-to-update';

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

        Yii::$app->view->title = 'Create '.Inflector::camel2Words($this->getShortName());

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

			if(Yii::$app->request->post('redirect') == self::REDIRECT_TO_UPDATE){
				$redirect = ['update', 'id' => $model->id];
			} else {
				$redirect = $this->redirect;
			}

			return $this->controller->redirect($redirect);
		} else {
			return $this->controller->render($this->view, [
				'model' => $model,
			]);
		}
	}
}
