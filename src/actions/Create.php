<?php

namespace bvb\crud\actions;

use Yii;

/**
 * Create is for creating models
 */
class Create extends CrudAction
{
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'manage' page.
     * @return mixed
     */
    public function run()
    {
       $model = new $this->model_class;
       if ($model->load(Yii::$app->request->post()) && $model->save()) {
           Yii::$app->session->addFlash('success', $this->getShortName().' created.');
           return $this->controller->redirect(['manage']);
       } else {
           return $this->controller->render('create', [
               'model' => $model,
           ]);
       }
    }
}
