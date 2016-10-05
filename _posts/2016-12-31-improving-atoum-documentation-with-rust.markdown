---
layout: post
title: "Improving atoum's documentation using Rusty"
date: 2016-12-31 09:00:00
author: "@agallou"
categories: news
---

## Introduction

atoum's documentation contains a lot of PHP examples. Sometimes, some of them did not work : those examples contained syntax errors.

Like this one below : a semicolon were missing at the end of the line. So, a user pasting it did not had a working example.

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

We will see how we removed those errors using Rusty.


## Rusty

[Rusty](https://github.com/K-Phoen/Rusty) is a tool written in PHP by [Kevin Gomez](http://www.kevingomez.fr/), that extracts code blocs within phpdoc blocks or markdown, and execute or lint them (the author as written a [blog post](http://blog.kevingomez.fr/2016/05/22/write-documentation-as-tests-in-php-using-rusty/) introducing the tool).


## Usage in atoum

### Adding support of RST

atoum's documentation uses [sphinx](http://www.sphinx-doc.org/) (it's hosted on [ReadTheDocs](https://readthedocs.org/)), so the documentation format is [RST](http://docutils.sourceforge.net/docs/ref/rst/restructuredtext.html).

Rusty supported markdown, but not RST. Fortunately, the architecture were in place on Rusty to add new formats. So we've made a [pull Request](https://github.com/K-Phoen/Rusty/pull/1) to add support of RST  (leaning on the [gregwar/rst](https://github.com/Gregwar/RST) library).


### Fixing the lint errors

Rusty could be launch like this:

```
./vendor/bin/rusty check --no-execute source/ -v
```

This command launches rusty without executing the content of the founded blocs (it only lints their content) of the files from the "source" folder.

The result of this command gives an output like this:

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


On this ouput, we can see that Rusty;

* will seek for supported file extensions (php, markdown, and RST);
* will parse those files and search for php code in markdown and RST documentation, or in PHPDoc;
* if php code are found, it will lint it : check that the syntax is correct
* in case of the syntax is not correct, the php code will be displayed alongside the error message.


On atoum's documentation Rusty allowed us, in a first step, to detect and fix numerous mistakes (you can can see them in this [pull Request](https://github.com/atoum/atoum-documentation/pull/209)).

### Automation of this checks

Fixing mistakes is a good this : avoid to having them appear ever again is better.

For that we've added a travis configuration to our documentation repository in order to alert (via the [pull request status](https://github.com/blog/1935-see-results-from-all-pull-request-status-checks)) the documentation writters when such a mistake is made.

You can see an example of an implementation of Rust on travis in this [pull Request](https://github.com/atoum/atoum-documentation/pull/210).

## Conclusion

Documentation is a major point in the adoption of an open-source project.

Working examples could make the diffrence in the choice of a library : using Rusty will allow you to improve your user's experience with your project's documentation.
