<?php

namespace bvb\crud\actions;

use Yii;
use yii\base\InvalidConfigException;

/**
 * Manage is for listing and searching models. It is abstract because it needs 
 * the $search_class property to be set to funciton
 */
class Manage extends CrudAction
{
    /**
     * The search class for the model used in listing models
     * @var yii\db\ActiveRecord
     */
    public $search_class;

    /**
     * The name of the file to be rendered for the view
     * @var string
     */
    public $view = 'index';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        if(empty($this->search_class)){
            throw new InvalidConfigException('Classes extending from the Manage CrudAction must set a `search_class`');
        }
    }

    /**
     * Lists all models.
     * @return mixed the result of the action
     */
    public function run()
    {
        $search_model = new $this->search_class;
        $data_provider = $search_model->search(Yii::$app->request->queryParams);

        return $this->controller->render($this->view, [
            'search_model' => $search_model,
            'data_provider' => $data_provider
        ]);
    }
}
