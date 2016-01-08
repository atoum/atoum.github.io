---
layout: static
---

# Features

<p class="header__paragraph">
    atoum is a full-featured testing framework. Judge for yourself.
</p>

<section class="visual-section">
## Flexible structure

Test suites, test cases, directory names… feel free to rename everything to fit your particular needs.
</section>

<section class="visual-section">
## Execution engines

By default, atoum provides three <a href="http://docs.atoum.org/en/latest/written_help.html#execution-engine">execution engines</a>:

<ul class="bare block-list">
    <li style="max-width: 25%">
        <img src="/images/icon/inline.svg" style="width: 100px; height: 100px; display: block; margin: 1rem auto"/>
        <strong>Inline</strong>, one test case after another in the same
        process,
    </li>
    <li style="max-width: 25%">
        <img src="/images/icon/isolate.svg" style="width: 100px; height: 100px; display: block; margin: 1rem auto"/>
        <strong>Isolate</strong>, one test case after another but each time in a
        new process,
    </li>
    <li style="max-width: 25%">
        <img src="/images/icon/concurrent.svg" style="width: 100px; height: 100px; display: block; margin: 1rem auto"/>
        <strong>Concurrent</strong>, “all” test cases at the same time in
        separated processes.
    </li>
</ul>

A specific engine can be defined per test case in addition to a default one with the <code>@engine</code> annotation.

Using the concurrent engine will provide a faster feedback, this will accelerate your development.
</section>

<section class="visual-section">
## Vocabulary

Depending of the kind of tests we are making, there is several ways to write a test case. The “classic” (old) way is procedural:

{% highlight php %}
<?php

$x      = 1;
$y      = 2;
$result = $x + $y;

$this->assertTrue($result === 3);
{% endhighlight %}

The “smarter” way by really using atoum's asserters:

{% highlight php %}
<?php

$x      = 1;
$y      = 2;
$result = $x + $y;

$this->integer($result)->isEqualTo(3);
{% endhighlight %}

The “academic” way:

{% highlight php %}
<?php

$this
    ->given(
        $x = 1,
        $y = 2
    )
    ->when($result = $x + $y)
    ->then
        ->integer($result)
            ->isEqualTo(3);
{% endhighlight %}

In the later example, the `given`, `when` and `then` keywords are “empty asserters”. They execute nothing. They are used to provide a better test case design.
</section>

<section class="visual-section">
## Meaningful asserters

atoum provides a <a href="http://docs.atoum.org/en/latest/asserters.html">full-featured set of natural and
expressive assertions</a> making test cases as much readable as possible. The following example asserts the integer
`150` is greater than `100` and lower than or equal to `200`:

{% highlight php %}
<?php

$this
    ->integer(150)
        ->isGreaterThan(100)
        ->isLowerThanOrEqualTo(200);
{% endhighlight %}

The following example asserts that `1 - 0.97` is nearly equal to `0.03` (which is
<a href="http://www.floating-point-gui.de/errors/comparison/">strictly false in Computer Science</a>):

{% highlight php %}
<?php

$this
    ->float(1 - 0.97)
        ->isNearlyEqualTo(0.03) // passes
        ->isEqualTo(0.03);      // fails
{% endhighlight %}

Arrays, strings, objects, exceptions… all of them have specific collections of asserters. In addition to provide a
better readability, they provide a better <strong>feedback</strong> when a test fails because atoum knows what you meant
to do.

A “**diff**” between the expected value and the computed value is also produced when a test fails.
</section>

<section class="visual-section">
## Mocks

Mocks able to close dependencies of your system under test. Test cases will be faster to build and to execute. atoum
provides mocking for:

* **Classes**, by simply using the top-namespace `mock` (case insensitive); for instance, the following example will
  mock the `Foo\Bar` class and will provide a new implementation for the `methodBaz` method:

{% highlight php %}
<?php

$mockedObject = new \Mock\Foo\Bar();

$this->calling($mockedObject)->methodBaz = function ($x) {
    return $x * 2;
};
{% endhighlight %}

* **Functions**, by using the `function` “asserter”; the following example will mock the
  <a href="http://php.net/session_start">`session_start`</a> PHP function and will provide a new implementation:

{% highlight php %}
<?php

$this->function->session_start = function () {
    return false;
};
{% endhighlight %}

* **Constants**, by using the `constant` “asserter”; the following example will mock the
  <a href="http://php.net/phpversion">`PHP_VERSION_ID`</a> constant and will provide a new value:

{% highlight php %}
<?php

$this->constant->PHP_VERSION_ID = 606060; // troll spotted
{% endhighlight %}

Mocks are generated at runtime and they are just that easy to use.

Of course, you can mock class constructor, you can control the value to compute each time a method is called, you can 
assert that a method has been called at least once etc.
</section>

<section class="visual-section">
## Virtual file system

When manipulating files or directories, having real files is not required. atoum provides a virtual file system allowing
to fake real files and directories. Enter `atoum://`. The following example will create a virtual file and the resulting
resource can be used like any other regular file resources:

{% highlight php %}
<?php

$file = atoum\mock\streams\fs\file::get('fakeFile');
fwrite($file, 'foobar');
rewind($file);
// …
stream_get_contents($file); // string(6) "foobar"
{% endhighlight %}

As expected, you can control the permissions, the ownership, different times, content, parents etc.
</section>

<section class="visual-section">
## Reports

Either test suites are run by one single user, or by a continous integration server. In both cases (but most importantly
in the latter), having test reports is crucial to understand failures, regressions, performances etc. That's why atoum
is able to produce several reports like:

* <a href="http://testanything.org/">TAP</a>, the Test Anything Protocol, a language agnostic format,
* <a href="https://confluence.atlassian.com/display/CLOVER/Clover+Documentation+Home">clover</a>, a software and a
  format for test reports,
* <a href="https://wiki.jenkins-ci.org/display/JENKINS/xUnit+Plugin">xUnit</a>, a Jenkins plugin and a format for test
  reports,
* Your own, yes, this is really easy to plug your own reporter.

Whatever you are using <a href="https://jenkins-ci.org/">Jenkins</a>, <a href="https://travis-ci.org/">Travis</a> or any
other well-known softwares, they are likely to understand atoum.
</section>

<section class="visual-section">
## Loop and autorun modes

In order to help you as much as possible, atoum provides the **loop mode**. Simply using the `--loop` option on the
command-line tool will run all the tests and it will wait you to press <kbd>Enter</kbd> before restarting the run. If
test cases were failling, atoum will **only re-run these ones**. You will save time and CPU. If no test cases were
failling, atoum will re-run all your test suites.

{% highlight sh %}
$ bin/atoum … --loop
…
Press <Enter> to reexecute, press any other key and <Enter> to stop...
{% endhighlight %}

The autorun helps you to run any test cases in any file like a regular PHP file if the runner is included. It means you
can avoid using the command-line tool. Thus, both following examples are equivalent (assuming the runner is included):

{% highlight sh %}
$ bin/atoum --files Test/Unit/Foo.php
$ # is equivalent to…
$ bin/atoum Test/Unit/Foo.php
$ # is equivalent to…
$ php Test/Unit/Foo.php
{% endhighlight %}
</section>

<section class="visual-section">
## Configuration file in PHP

atoum's configuration file is written in PHP. No YAML, no XML, no strange language. Only PHP for a maximum flexibility.

{% highlight php %}
<?php

$script->addDefaultArguments(
    '--debug',
    '--use-tap-report',
    '--loop'
);
$runner->addTestsFromDirectory(__DIR__ . '/Test/Unit/');
// …
{% endhighlight %}

Note the global `$script` and `$runner` variables: reach any part of atoum to fit in your own workflow.
</section>

<section class="visual-section">
## Third-party integration

atoum integrates well with the following non-exhaustive softwares or services:

<ul class="columns" data-columns="3" style="margin: 0 auto; max-width: 500px">
    <li><a href="https://atom.io/">Atom</a>,</li>
    <li><a href="https://circleci.com/">Circle CI</a>,</li>
    <li><a href="https://getcomposer.org/">Composer</a>,</li>
    <li><a href="http://portablegvim.sourceforge.net/">GVim</a>,</li>
    <li><a href="https://jenkins-ci.org/">Jenkins</a>,</li>
    <li><a href="https://maven.apache.org/">Maven</a>,</li>
    <li><a href="https://www.jetbrains.com/phpstorm/">PHPStorm</a>,</li>
    <li><a href="http://www.phing.info/">Phing</a>,</li>
    <li><a href="https://scrutinizer-ci.com/">Scrutinizer CI</a>,</li>
    <li><a href="http://www.sublimetext.com/">Sublime Text</a>,</li>
    <li><a href="https://travis-ci.org/">Travis CI</a>,</li>
    <li><a href="http://www.vim.org/">Vim</a>,</li>
    <li><a href="https://wiki.gnome.org/Apps/Gedit">gedit</a>,</li>
    <li><a href="https://github.com/macvim-dev/macvim">macvim</a>.</li>
</ul>
</section>

<section class="visual-section">
## Fast

First, atoum comes with a concurrent engine, which makes it fast (and secure) by default. Second, atoum is lightweight.
For instance, the following table shows the time and memory required to run atoum's test suite and
<a href="http://hoa-project.net/">Hoa</a>'s test suite, which are known to be important and intensive, both in terms of
computation and memory:

<table style="max-width: 500px">
    <caption>This table illustrates how fast atoum is by showing numbers about
        big test suites.</caption>
    <thead>
    <tr>
        <th></th>
        <th>atoum</th>
        <th>Hoa</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Test suites</td>
        <td>224</td>
        <td>81</td>
    </tr>
    <tr>
        <td>Test cases</td>
        <td>1816</td>
        <td>611</td>
    </tr>
    <tr>
        <td>Assertions</td>
        <td>26,774</td>
        <td>177,976</td>
    </tr>
    <tr class="table--double-separator">
        <td>Time</td>
        <td>25s</td>
        <td>93s</td>
    </tr>
    <tr>
        <td>Memory</td>
        <td>58Mb</td>
        <td>50Mb</td>
    </tr>
    </tbody>
</table>
</section>

<section class="visual-section">
## Extensions

atoum is extensible. The community writes extensions and the organization of atoum hosts and maintains some of them,
like:

* <a href="https://github.com/atoum/bdd-extension"><code>atoum/bdd-extension</code></a>, to write BDD-like test cases,
* <a href="https://github.com/atoum/reports-extension"><code>atoum/reports-extension</code></a>, to write code coverage
  reports (showing branch and path coverage on the code or on the control flow graph),
* <a href="https://github.com/atoum/ruler-extension"><code>atoum/ruler-extension</code></a>, to precisely filter test
  cases to run with a “natural language”,
* <a href="https://github.com/atoum/json-schema-extension"><code>atoum/json-schema-extension</code></a>, to validate
  JSON documents with new asserters,
* <a href="https://github.com/atoum/visibility-extension"><code>atoum/visibility-extension</code></a>, to bypass the
  visibility of methods.

Most of the time, to install an extension you will just need to include it in your dependencies and add one line in your
configuration file, like:

{% highlight php %}
<?php

$extension = new mageekguy\atoum\ruler\extension()
$extension->addToRunner($runner);
{% endhighlight %}
</section>
