Google Analytics Module for Omeka-S
====================

An Omeka-S module which adds the required Javascript for Google Analytics tracking of pages.

Currently supported versions of Omeka-S: 1.0.0beta1 - 1.0.0beta5

[![Build Status](https://travis-ci.org/digirati-co-uk/omeka-google-analytics-module.svg?branch=master)](https://travis-ci.org/digirati-co-uk/omeka-google-analytics-module)

Installation via Zip file
------------
1.) Visit the projects release page (https://github.com/digirati-co-uk/omeka-google-analytics-module/releases/latest)

2.) Download the Zip of the most recent release


3.) Place this folder within your `Modules` folder in your Omeka-S installtion


4.) Rename the folder from `omeka-google-analytics-module` to `GoogleAnalytics`

Installation via Composer
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).


```
php composer.phar require digirati/omeka-google-analytics-module
```



Basic Usage
-----------

Once the module is installed within the file system you must activate and configure the module in the Omeka-s `admin/modules` user interface.

The configuration is very simple and you are only required to provide your Google Analytics Tracking Code this is usually prefixed `UA` and can be found within your Google Analytics Account page.

Once Configured the required Javascript for Google Analytics tracking will be placed on your Omeka pages with your unique tracking code embedded. 

It will take approx 24-48 hours before you are able to see the results in your Google Analytics account.


Contributors
------------

[TODO]
