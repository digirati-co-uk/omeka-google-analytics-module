<?php

namespace GoogleAnalytics\Admin;

use Zend\Form\Form;

class ConfigurationForm extends Form
{
    public function init()
    {
        $this->add([
            'type' => 'text',
            'name' => 'google_analytics_key',
            'options' => [
                'label' => 'Google Analytics tracking code',
                'info' => 'The tracking code to be used in Google Analytics tracking snippets',
            ],
        ]);
    }
}
