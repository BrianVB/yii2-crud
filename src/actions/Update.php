<?php

namespace bvb\crud\actions;

use bvb\stripe\backend\models\Product;
use bvb\stripe\backend\models\Plan;
use bvb\stripe\backend\models\PlanSearch;
use bvb\stripe\common\helpers\ProductHelper;
use Yii;
use yii\base\Action;
use yii\web\NotFoundHttpException;

/**
 * Update is for updating Product models
 */
class Update extends CrudAction
{
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
            return $this->controller->redirect(['manage']);
        } else {
            return $this->controller->render('update', [
                'model' => $model,
            ]);
        }
    }
}
