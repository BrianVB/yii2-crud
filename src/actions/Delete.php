<?php

namespace bvb\crud\actions;

use Yii;

/**
 * Delete is for deleting models
 */
class Delete extends CrudAction
{
    /**
     * Deletes an existing model.
     * If deletion is successful, the browser will be redirected to the 'manage' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function run($id)
    {
        if( !($model = $this->model_class::findOne($id)) ){
            throw new NotFoundHttpException('The requested '.strtolower($this->getShortName().' does not exist.');
        }

        $model->delete();
        Yii::$app->session->addFlash('success', $this->getShortName().' deleted.');
        return $this->controller->redirect(['manage']);
    }
}
