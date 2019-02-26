<?php

namespace bvb\crud\actions;

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
     * The name of the file to be rendered for the view
     * @var string
     */
    public $view = 'index';

    /**
     * Buttons to be rendered in the toolbar. 
     * If left null, will default to a link to create a new model @see [[init()]]
     * Setting this to false will force it not to render any tooolbar buttons
     * @var string
     */
    public $toolbarButtons;

    /**
     * If the searchModelClass is not set in this then it will try to default it to the name of the
     * modelClass appended by 'Search'. 
     * Will set the toolbar buttons with a link to create a new model
     * Set the default title for the view to be 'Manage [[modelClass]]''
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        if(empty($this->searchModelClass)){
            $this->searchModelClass = $this->modelClass.'Search';
        }

        Yii::$app->view->title = 'Manage '.Inflector::camel2words(Inflector::pluralize($this->getShortName()));

        if($this->toolbarButtons === null){
            Yii::$app->view->toolbar['buttons'] = Html::a('New '.Inflector::camel2words($this->getShortName()), ['create'], ['class' => 'btn btn-success']);
        } else if(!empty($this->toolbarButtons)){
            Yii::$app->view->toolbar['buttons'] = $this->toolbarButtons;
        }
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
}
