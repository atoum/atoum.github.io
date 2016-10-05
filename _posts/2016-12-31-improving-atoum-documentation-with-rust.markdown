---
layout: post
title: "Improving atoum's documentation using Rusty"
date: 2016-12-31 09:00:00
author: "@agallou"
categories: news
---

## Introduction

atoum's documentation contains a lot of PHP examples. Sometimes they don't work because of syntax errors.

In the example below, a semicolon is missing at the end of the line. So, a user pasting it won't have a working example.

{% highlight rst %}
``length`` allows you to get an asserter of type integer that contains the string's size.

.. code-block:: php

  <?php
   $string = 'atoum'

   $this
       ->string($string)
           ->length
               ->isGreaterThanOrEqualTo(5)
   ;

{% endhighlight %}

Let's look at how we removed errors like this using Rusty.


## Rusty

[Rusty](https://github.com/K-Phoen/Rusty) is a tool written in PHP by [Kevin Gomez](http://www.kevingomez.fr/). It extracts code blocks within phpdoc blocks or markdown, and executes or lints them (the author has written a [blog post](http://blog.kevingomez.fr/2016/05/22/write-documentation-as-tests-in-php-using-rusty/) introducing the tool).


## Usage in atoum

### Adding support for RST

atoum's documentation uses [sphinx](http://www.sphinx-doc.org/) (it's hosted on [ReadTheDocs](https://readthedocs.org/)), so the documentation format is [RST](http://docutils.sourceforge.net/docs/ref/rst/restructuredtext.html).

When we started using it, Rusty supported markdown, but not RST. Fortunately, Rusty's architecture enables you to add new formats. So we made a [pull Request](https://github.com/K-Phoen/Rusty/pull/1) to add support of RST (based on the [gregwar/rst](https://github.com/Gregwar/RST) library).


### Fixing linting errors

We launch Rusty like this:

```
./vendor/bin/rusty check --no-execute source/ -v
```

This command launches Rusty and only lints the content of the files in the "source" folder. Code blocks are not executed.

The result of this command is the following output:

{% highlight bash %}
⚑ Analysing file source/en/first_test.rst
 → Found code sample in line 0
 ✘ Syntax error in source/en/first_test.rst:0

```
namespace Vendor\Project;

class HelloWorld
{
    public function getHiAtoum ()
    {
        return 'Hi atoum !'
    }
}
```

  [Rusty\Lint\Exception\SyntaxError]
  Syntax error in code sample "

  namespace Vendor\Project;
  class HelloWorld
  {
    public function getHiAtoum ()
    {
      return 'Hi atoum !'
    }
  }" in /sources/source/en/first_test.rst:0 → Syntax error, unexpected '}', expecting ';' on line 10
{% endhighlight %}


From this ouput, we can see that Rusty;

* will search for supported file extensions (php, markdown, and RST);
* will parse those files and search for php code in markdown and RST documentation, or in PHPDoc;
* if php code is found, it will lint it and check that the syntax is correct
* where it finds syntax errors, the offending php code will be displayed alongside the error message.


As a first step in improving atoum's documentation, Rusty helped us detect and fix numerous mistakes (you can can see them in this [pull Request](https://github.com/atoum/atoum-documentation/pull/209)).

### Automating checks

Fixing mistakes is good. Avoiding them reappearing is even better.

For that we've added a travis configuration to our documentation repository in order to alert (via the [pull request status](https://github.com/blog/1935-see-results-from-all-pull-request-status-checks)) the documentation writers when such a mistake occurs.

You can see an example of an implementation of Rusty on travis in this [pull Request](https://github.com/atoum/atoum-documentation/pull/210).

## Conclusion

Documentation is a major point in the adoption of an open-source project.

Good quality, working examples can make all the difference in the choice of a library. Using Rusty helps you improve the experience your users have of your project's documentation.
