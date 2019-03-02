<?php

namespace bvb\crud\widgets;

use bvb\crud\actions\Create;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * RedirectToUpdateButton is similar to the functionality of [[bvb\crud\widgets\RedirectButton]] by providing
 * a button with a value that the action [[bvb\crud\actions\Create]] will recognize
 * The value of the button should be set to the URL to be redirected to
 * This is especially useful for using on forms that impelement [[\bvb\crud\actions\Update]]
 * where you want a successful form submission to redirect to a specific URL
 */
class RedirectToUpdateButton extends Widget
{
    /**
     * @var array options passed to the call to [[\yii\helpers\Html::button()]]
     */
    public $options = [];

    /**
     * @var array Key/value pairs that will be appended to the 'update' URL as query parameters
     */
    public $url_params = [];

    /**
     * @var string the text displayed by the button
     */
    public $content = 'Save &amp; Continue';

    /**
     * Renders a submit button with the 
     * {@inheritdoc}
     */
    public function run()
    {
        $defaultOptions = [
            'type' => 'submit',
            'class' => 'btn btn-success redirect-to-update-btn',
            'name' => 'redirect'
        ];
        $value = Create::REDIRECT_TO_UPDATE;
        if(!empty($this->url_params)){
            $value .= '?'.http_build_query($this->url_params);
        }
        $options = ArrayHelper::merge($defaultOptions, $this->options, ['value' => $value]);
        return Html::button($this->content, $options);
    }
}
