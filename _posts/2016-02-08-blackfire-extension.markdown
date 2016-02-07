---
layout: post
title: "Execute blackfire assertions inside atoum"
date: 2016-02-08 09:00:00
author: "@agallou"
categories: description
---

Intro
-----

Since the release of its [version 2](http://blog.blackfire.io/blackfire-v2-0-automate-performance-testing.html), [Blackfire](blackfire.io) allows the automation of performance tests.

blackfire provides a [PHP SDK](https://blackfire.io/docs/reference-guide/php-sdk) that, among other things, allows to integrate performance tests inside PHPUnit : you can check that your code doesn't exhausts a memory limit, an execution time or a number of calls for a function/method.

How could we integrate those tests inside atoum in order to benefit from the greatness of atoum assertions ?

Installation
------------

You need to have [blackfire](https://blackfire.io/docs/up-and-running/installation) and [atoum](http://docs.atoum.org/en/latest/getting_started.html#installation) installed.

First, we need to install atoum's blackfire extension via composer.

{% highlight bash %}
composer require atoum/blackfire-extension
{% endhighlight %}

Then we need to configure the client id and token to access blackfire. We do that by adding a few lines in the `.atoum.php` file. For example here is how to do it when those variable are accessible as environnement variables: 

{% highlight php %}
<?php

$extension = new mageekguy\atoum\blackfire\extension();
$extension
    ->setClientConfiguration(new \Blackfire\ClientConfiguration($_ENV['BLACKFIRE_CLIENT_ID'], $_ENV['BLACKFIRE_CLIENT_TOKEN']))
    ->addToRunner($runner)
;
{% endhighlight %}

Usage
-----

The extension will provide a new asserter : `blackfire`.

Those methods can be called from this new asserter: 

* assert
* defineMetric
* profile

Let's take this test as an example:

{% highlight php %}
<?php

namespace Tests\Units;

use Example as TestedClass;

use atoum;

class Example extends atoum
{
    public function testExemple()
    {
        $this
            ->blackfire
                ->assert('main.wall_time < 2s')
                ->profile(function() {
                    sleep(4);
                    // call code to instrument
                })
        ;
    }
}

{% endhighlight %}

This test will check that the code inside the anonymous function will not take more than 2 seconds to be executed.

Here we've added a `sleep(4)` to make the test fail, so an output like this will be displayed:

![Output blackfire atoum](/images/posts/2016-02-08-blackfire-extension/screenshot.png)

The callback has been called, instrumented by blackfire, sent to blackfire.io. blackfire.io has sent us the assertions results which have been integrated inside the unit tests results.

This a an example based on the execution time. You can define more usefull assertions like this:

{% highlight php %}
<?php

namespace Tests\Units;

use Example as TestedClass;

use atoum;

class Example extends atoum
{
    public function testExemple()
    {
        $this
            ->blackfire
                // adds a metric named `example_foo_calls` on the number of calls on the `foo` method of the `Example` class
                ->defineMetric(new \Blackfire\Profile\Metric("example_foo_calls", "=Example::foo"))

                // adds a blackfire assertion to check if the foo method is called more than 10 times
                ->assert("metrics.example_foo_calls.count < 10")

                ->profile(function() {
                    $testedClass = new Example();
                    for ($i = 0; $i < 12; $i++) {
                        $testedClass->foo();
                    }
                })
        ;
    }
}

{% endhighlight %}


Avoid running those tests
-------------------------

In order to only execute those tests, you can use the `extensions` tag ([read the documentation about it](http://docs.atoum.org/en/latest/written_help.html#php-extensions)) and atoum's `ruler-extension` that will allow you [to filter the tests that needs blackfire](https://github.com/atoum/ruler-extension#filter-on-the-test-required-extensions) (or filter the tests that does not need blackfire).

For example, you can launch all the tests that do not need the blackfire php extension like this:

{% highlight bash %}
./vendor/bin/atoum -d tests --filter 'not(extensions contains "blackfire")'
{% endhighlight %}


Last thoughts
-------------

This extension requires a least the version 2.5.0 of atoum : [read the 2.5.0 announcement](http://atoum.org/release/2016/01/08/release-2-5-0.html).

A lot of [metric](https://blackfire.io/docs/reference-guide/metrics) and [variables](https://blackfire.io/docs/reference-guide/assertions) are available out of the box. As we saw previousely, you can define your own metric. So don't hesitate to add those assertions in your unit tests.

