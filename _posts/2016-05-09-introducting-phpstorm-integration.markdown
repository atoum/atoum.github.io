---
layout: post
title: "Introducing PHPStorm integration"
date: 2016-05-09 10:00:00
author: "@agallou"
categories: release
---

Introduction
------------

Until recently, atoum was not integrated in Jetbrain's IDE, [PhpStorm](https://www.jetbrains.com/phpstorm/).

Since several weeks, this is no longer the case : atoum's plugin for PHPStorm is live.

We're gonna take a tour of this plugin.


Go from test to the tested class
--------------------------------

When writing unit tests, and even more when doing TDD, we often switch from the test to the tested class. 

The plugin adds an icon in front of the name of the tested class to go to the test class. It also does the opposite and adds an icon in front of the test class.

A keyboard shortcut is also available for a faster usage of this functionality.

![Switch](/images/posts/2016-05-09-introducting-phpstorm-integration/switch-icon.png)


Test identification
-------------------

The file's icon will change when it contains a unit test: it will have the atoum's logo.

This will allow you to easily disinguish the test file from the tested file when those are displayed in the tabbar.

![Tabs](/images/posts/2016-05-09-introducting-phpstorm-integration/custom_icon-tabs.png)


Running tests
-------------

Finally, you now can run your tests right from the IDE. The results will be displayed as a nice treeview, listing which methods have passed or failed (and the that case, with the error details):

<style type="text/css">
    img[alt="Run"] {
        max-width: 100%;
    }
</style>

![Run](/images/posts/2016-05-09-introducting-phpstorm-integration/run.png)


Conclusion
----------

As we haven seen, the plugin will allow to write your tests faster, without even leaving your IDE.

You can install the plugin, directly from the IDE. Installation instructions can be be found in the project's [README](https://github.com/atoum/phpstorm-plugin).

Don't hesitate to contribute, either by submitting a pull request, opening an [issue](https://github.com/atoum/phpstorm-plugin/issues) or giving us feedback on your usage of the plugin. 
