<?php

namespace bvb\crud\actions;

use bvb\crud\helpers\Helper;
use ReflectionClass;
use Yii;
use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\base\InvalidConfigException;

/**
 * Manage is for listing and searching models. 
 */
class Manage extends Action
{
    /**
     * @var yii\db\ActiveRecord The search class for the model used in listing models
     */
    public $searchModelClass;

    /**
     * @var string The name of the file to be rendered for the view
     */
    public $view = 'index';

    /**
     * Sets default searchModelClass if not set
     * Will set the toolbar buttons with a link to create a new model
     * Set the default title for the view to be 'Manage [[modelClass]]''
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        if(empty($this->searchModelClass)){
            $this->searchModelClass = $this->getDefaultSearchModelClass();
        }

        Yii::$app->view->title = 'Manage '.Inflector::camel2words(Inflector::pluralize($this->getModelShortName()));
    }

    /**
     * Lists all models.
     * @return mixed the result of the action
     */
    public function run()
    {
        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id);
        }

        $searchModel = new $this->searchModelClass;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->controller->render($this->view, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function getDefaultToolbarButtons()
    {
        return Html::a('New '.Inflector::camel2words($this->getModelShortName()), ['create'], ['class' => 'btn btn-success']);
    }

    /**
     * @return string The default name for the search model class which would be the model class name with 'Search' appended
     */
    protected function getDefaultSearchModelClass()
    {
        return Helper::getDefaultSearchModelClass($this->modelClass);
    }
}
