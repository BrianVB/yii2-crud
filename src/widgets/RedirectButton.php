<?php

namespace bvb\crud\widgets;

use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * RedirectButton creates a submit button for forms with the name 'redirect'
 * The value of the button should be set to the URL to be redirected to
 * This is especially useful for using on forms that impelement [[\bvb\crud\actions\Update]]
 * where you want a successful form submission to redirect to a specific URL
 */
class RedirectButton extends Widget
{
    /**
     * @var string the URL to be redirected to
     */
    public $url;

    /**
     * @var array options passed to the call to [[\yii\helpers\Html::button()]]
     */
    public $options = [];

    /**
     * @var string the text displayed by the button
     */
    public $content = 'Submit';

    /**
     * Renders a submit button with the 
     * {@inheritdoc}
     */
    public function run()
    {
        $defaultOptions = [
            'type' => 'submit',
            'class' => 'btn btn-success redirect-btn',
            'name' => 'redirect'
        ];
        $options = ArrayHelper::merge($defaultOptions, $this->options, ['value' => $this->url]);
        return Html::button($this->content, $options);
    }
}
