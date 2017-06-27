<?php

namespace GoogleAnalytics\Events;

use Omeka\Settings\Settings;
use Zend\View\Helper\HeadScript;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\ViewEvent;

/**
 * A {@code ViewModel} event listener which modifies {@link View}s by appending a Google Analytics tracking script.
 */
final class GoogleScriptTagEventListener
{
    /**
     * @var Settings
     */
    private $settings;

    /**
     * @param Settings $settings
     */
    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
    }

    public function __invoke(ViewEvent $event)
    {
        $renderer = $event->getRenderer();

        if (!($renderer instanceof PhpRenderer)) {
            return;
        }

        $model = $event->getModel();
        $children = $model->getChildren();

        if (empty($children) || count($children) > 1) {
            // either in a child template, or several child templates being rendered
            // too late to append to head scripts / inline scripts
            return;
        }

        $child = current($children);
        $childTemplate = $child->getTemplate();

        // Rudimentary test for pages we want to disable Google Analytics on.
        // @todo - this needs to be more robust
        if (strpos($childTemplate, 'admin') !== false) {
            return;
        }

        $jsTrackingCode = $renderer->escapeJs($this->settings->get('google_analytics_key'));
        $renderer
            ->headScript(HeadScript::SCRIPT)
            ->appendScript(<<<JS
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', '$jsTrackingCode', 'auto');
  ga('send', 'pageview');
JS
            );
    }

}
