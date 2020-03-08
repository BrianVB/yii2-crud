<?php

namespace bvb\crud\actions;

use bvb\crud\helpers\Helper;
use kartik\form\ActiveForm;
use Yii;
use yii\base\Model;
use yii\helpers\Html;
use yii\helpers\Inflector;

/**
 * Update is for updating models
 */
class Update extends Action
{
    /**
     * Configuration for a form that this action will set as a view parameter
     * to be wrapped around the rendered view
     */
    public $formConfig = [
        'class' => ActiveForm::class
    ];

    /**
     * @var string the scenario to be assigned to the model before it is validated and updated.
     */
    public $scenario = Model::SCENARIO_DEFAULT;

    /**
     * @var string The name of the file to be rendered for the view
     */
    public $view = 'update';

    /**
     * @var string Success messsage to be show after successful update
     */
    public $flashSuccessMessage;

    /**
     * The name of the file to be rendered for the view
     * @var string
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

        // --- Sets the title and the toolbar
        Yii::$app->view->title = 'Update '.Inflector::camel2words($this->getModelShortName());

        if(!empty($this->formConfig)){
            Yii::$app->view->form = Yii::createObject($this->formConfig);
        }
    }

    /**
     * Updates an existing model.
     * Allows setting a POST variable 'redirect' to set a custom redirect. For easy use of this feature
     * see [[\bvb\crud\widgets\RedirectButton]] which will render a submit button which if pressed will set the
     * 'redirect' variable and use the value on the button
     * @param string $id the primary key of the model.
     * @return mixed Either a redirect or a string rendering of the page
     */
    public function run($id)
    {
        $model = $this->findModel($id);

        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id, $model);
        }

        $model->setScenario($this->scenario);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->addFlash('success', $this->getFlashSuccessMessage());

            if(strpos(Yii::$app->request->post('redirect'), Helper::SAVE_AND_CONTINUE) !== false){
                return $this->controller->refresh();
            }
            // --- If a custom redirect was passed in then use it
            return $this->controller->redirect(Yii::$app->request->post('redirect') ? Yii::$app->request->post('redirect') : $this->redirect);
        } else {
            return $this->controller->render($this->view, [
                'model' => $model,
            ]);
        }
    }

    /**
     * Returns a default flash success message if one isn't configured
     * @return string
     */
    private function getFlashSuccessMessage()
    {
        if(empty($this->flashSuccessMessage)){
            return Inflector::camel2words($this->getModelShortName()).' updated.';
        }
        return $this->flashSuccessMessage;
    }

    /**
     * {@inheritdoc}
     */
    protected function getDefaultToolbarButtons()
    {
        return Html::submitButton('Save', ['class' => 'btn btn-success']);
    }
}
