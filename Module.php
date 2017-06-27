<?php

namespace GoogleAnalytics;

use GoogleAnalytics\Admin\ConfigurationForm;
use GoogleAnalytics\Events\GoogleScriptTagEventListener;
use Omeka\Module\AbstractModule;
use Zend\Config\Factory;
use Zend\EventManager\SharedEventManagerInterface;
use Zend\Mvc\Controller\AbstractController;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\View;
use Zend\View\ViewEvent;

class Module extends AbstractModule
{
    private $config;

    public function getConfig()
    {
        if ($this->config !== null) {
            return $this->config;
        }

        $this->config = Factory::fromFiles(
            glob(__DIR__ . '/config/*.config.*')
        );

        return $this->config;
    }

    public function getConfigForm(PhpRenderer $renderer)
    {
        $settings = $this->getServiceLocator()->get('Omeka\Settings');

        $form = new ConfigurationForm();
        $form->init();
        $form->setData([
            'google_analytics_key' => $settings->get('google_analytics_key'),
        ]);

        return $renderer->formCollection($form, false);
    }

    public function handleConfigForm(AbstractController $controller)
    {
        $settings = $this->getServiceLocator()->get('Omeka\Settings');

        $form = new ConfigurationForm();
        $form->init();
        $form->setData($controller->params()->fromPost());

        if (!$form->isValid()) {
            $controller->messenger()->addErrors($form->getMessages());
            return false;
        }

        $formData = $form->getData();
        $settings->set('google_analytics_key', $formData['google_analytics_key']);

        return true;
    }

    public function attachListeners(SharedEventManagerInterface $eventManager)
    {
        $subscriber = $this->getServiceLocator()->get(GoogleScriptTagEventListener::class);
        $eventManager->attach(View::class, ViewEvent::EVENT_RENDERER_POST, $subscriber);
    }
}
