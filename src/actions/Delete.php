<?php

namespace bvb\crud\actions;

use Yii;
use yii\helpers\Inflector;

/**
 * Delete is for deleting models
 */
class Delete extends Action
{
    /**
     * @var string The route to redirect to after successful deletion
     */
    public $redirect = ['index'];

    /**
     * Deletes an existing model.
     * If deletion is successful, the default redirection is to the index action
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
        Yii::$app->session->addFlash('success', Inflector::camel2words($this->getModelShortName()).' deleted.');

        if(!$redirect){
            $redirect = $this->redirect;
        }

        return $this->controller->redirect($redirect);
    }
}
