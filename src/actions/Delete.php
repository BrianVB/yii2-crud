<?php

namespace bvb\crud\actions;

use Yii;

/**
 * Delete is for deleting models
 */
class Delete extends Action
{
    /**
     * The route to redirect to after successful deletion
     * @var string
     */
    public $redirect = ['index']; // --- Defaults to the Manage action in the ActiveController

    /**
     * Deletes an existing model.
     * If deletion is successful, the browser will be redirected to the 'manage' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function run($id, $redirect = null)
    {
        $model = $this->findModel($id);
        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id, $model);
        }

        $model->delete();
        Yii::$app->session->addFlash('success', $this->getShortName().' deleted.');

        if(!$redirect){
            $redirect = $this->redirect;
        }

        return $this->controller->redirect($redirect);
    }
}
