<?php

use GoogleAnalytics\Events\GoogleScriptTagEventListener;
use Psr\Container\ContainerInterface;

return [
    'service_manager' => [
        'factories' => [
            GoogleScriptTagEventListener::class => function (ContainerInterface $container) {
                return new GoogleScriptTagEventListener(
                    $container->get('Omeka\Settings')
                );
            },
        ],
    ],
];
