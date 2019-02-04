<?php

namespace bvb\crud\actions;

use Yii;
use yii\base\Action;
use yii\web\NotFoundHttpException;

/**
 * Update is for updating models
 */
class Update extends CrudAction
{
    /**
     * The name of the file to be rendered for the view
     * @var string
     */
    public $view = 'index';

    /**
     * The name of the file to be rendered for the view
     * @var string
     */
    public $redirect = ['manage'];

    /**
     * Updates the model
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function run($id)
    {
        if( !($model = $this->model_class::findOne($id)) ){
            throw new NotFoundHttpException('The requested '.strtolower($this->getShortName()).' does not exist.');
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
