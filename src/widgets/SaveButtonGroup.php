<?php

namespace bvb\crud\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * SaveButtonGroup renders a Bootstrap 4 button group dropdown using a split
 * button style with Save (& Exit) being the default and & Continue being a
 * default in the dropdown. Extra buttons can also be added using the [[button]]
 * property
 */
class SaveButtonGroup extends Widget
{
    /**
     * Content of the save submit button
     * @var string
     */
    public $saveButtonContent = 'Save';

    /**
     * Array configuration for the save and continue button that will be merged
     * with the default configuration
     * @var array 
     */
    public $saveAndContinueButton = [];

    /**
     * Array of strings which are extra buttons to be rendered in the dropdown
     * @var array
     */
    public $buttons = [];

    /**
     * Renders a submit button with the 
     * {@inheritdoc}
     */
    public function run()
    {
        $saveBtn = Html::submitButton($this->saveButtonContent, ['class' => 'btn btn-success']);
        if($this->saveAndContinueButton !== null){
            $saveAndContinueButtonDefault = [
                'class' => SaveAndContinueButton::class,
                'content' => 'Continue',
                'options' => [
                    'class' => 'dropdown-item'
                ]
            ];

            array_unshift($this->buttons, Yii::createObject(ArrayHelper::merge($saveAndContinueButtonDefault, $this->saveAndContinueButton))->run());
        }

        $dropdownToggleBtn = Html::button(
            '&amp;...&nbsp;&nbsp;&nbsp;&nbsp; </span>',
            [
                'class' => 'btn btn-last btn-success dropdown-toggle dropdown-toggle-split',
                'type' => 'button',
                'data-toggle' => 'dropdown',
                'aria-haspopup' => 'true',
                'aria-expanded' => 'false'      
            ]
        );

        $dropdownContents = '';
        foreach($this->buttons as $button){
            $dropdownContents .= Html::tag('div', $button, ['class' => 'dropdown-item']);
        }

        $dropdownMenu = Html::tag('div', $dropdownContents, ['class' => 'dropdown-menu dropdown-menu-right']);
        return Html::tag('div', $saveBtn.$dropdownToggleBtn.$dropdownMenu, ['class' => 'btn-group']);
    }
}
