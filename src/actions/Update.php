<?php

namespace bvb\crud\actions;

use Yii;
use yii\web\NotFoundHttpException;
use yii\helpers\Html;

/**
 * Update is for updating models
 */
class Update extends Action
{
    /**
     * @var string The name of the file to be rendered for the view
     */
    public $view = 'update';

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

        Yii::$app->view->title = 'Update '.$this->getShortName();

        Yii::$app->view->params['toolbar']['buttons'] = Html::submitButton('Save', ['class' => 'btn btn-success']);
    }

    /**
     * Updates the model
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function run($id)
    {
        $model = $this->findModel($id);

        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id, $model);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->addFlash('success', $this->getShortName().' updated.');
            return $this->controller->redirect($this->redirect);
        } else {
            return $this->controller->render($this->view, [
                'model' => $model,
            ]);
        }
    }
}
