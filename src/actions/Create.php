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
	 * @var mixed Route to redirect to after successful creation
	 */
	public $redirect = ['index'];

    /**
     * Add submit button to the toolbar
     * Initialize the form used to create the model
     * Set the default title for the view to be 'Create [[modelClass]]''
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        if(empty(Yii::$app->view->title)){
        	Yii::$app->view->title = 'Create '.Inflector::camel2Words($this->getModelShortName());
        }

        if(!empty($this->formConfig)){
            Yii::$app->view->form = Yii::createObject($this->formConfig);
        }
    }

	/**
	 * Creates a new model.
	 * @return mixed
	 */
	public function run()
	{
		if ($this->checkAccess) {
			call_user_func($this->checkAccess, $this->id);
		}

		$model = Yii::createObject(\yii\helpers\ArrayHelper::merge(
			['class' => $this->modelClass],
			$this->modelDefaults
		));

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			Yii::$app->session->addFlash('success', Inflector::camel2Words($this->getModelShortName()).' created.');

			if(strpos(Yii::$app->request->post('redirect'), self::REDIRECT_TO_UPDATE) !== false){
                $redirect = ['update', 'id' => $model->id];

                // --- Check for additional params
                $parts = parse_url(Yii::$app->request->post('redirect'));
                if(!empty($parts['query'])){
                    $parts = parse_str($parts['query'], $query);
                    $redirect = array_merge($redirect, $query);
                }
			} else {
				$redirect = $this->redirect;
			}

			return $this->controller->redirect($redirect);
		} else {
			if($model->hasErrors()){
				Yii::debug(\yii\helpers\VarDumper::dumpAsString($model));
			}
			return $this->controller->render($this->view, [
				'model' => $model,
			]);
		}
	}

	/**
	 * {@inheritdoc}
	 */
	protected function getDefaultToolbarButtons()
	{
		return Html::submitButton('Save', ['class' => 'btn btn-success']);
	}
}
