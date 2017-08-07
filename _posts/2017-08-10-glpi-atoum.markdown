---
layout: post
title: "GLPI migrate to atoum"
date: 2017-08-10 10:00:00
author: "@Grummfy"
categories: news
---

The [GLPI project][GLPI] [recently announced][announced-en][^1] that they have migrated their unit test suites to atoum. So let's get back on
this news. We interviewed [Johan Cwiklinski](https://github.com/trasher) and some other members of the project's official team about this migration.

## 1. Can you summary the GLPI project and the usage of PHP inside it?

[GLPI][GLPI] is an open source IT asset management and Service Desk software. The project has started 15 years ago and is written in PHP.
The project was led by an association until 2015, and since then the development is headed by [Teclib](www.teclib.com).

Since 2015, we are trying to rewrite and modernize the whole project, starting with the backend.

## 2. When did you start using unit test for the project?

Firstly, one regular contributor has tried to add unit tests into the project in 2010. But project managers did not follow him, and it was quickly abandoned.
Forward to 2015, the same contributor tried again to add tests on the project, with much more success :)

## 3. What kind of difficulties do you encounter with PHPUnit? Why did you choose atoum instead of other tools to resolve it?

We didn’t really face issues with PHPUnit. This is more a technical choice that was led by atoum capabilities, like:

* testing variable types (if you test an integer and get a string, this is not correct),
* wonderful mocking system (that allows mocking PHP native functions, constants, …),
* use closure to test outputs, exceptions, … (way more interesting than PHPUnit’s annotations),
* concurrent run of test cases (even if it has been disabled for GLPI),
* fully isolated test cases,
* chained calls,
* more natural way to write tests (this is maybe just my point of view - but this is really simpler to me).

Last but not least: atoum is a French project at the origin, just like GLPI!

## 4. Did you face some issues during the migration from PHPUnit to atoum?

Well… We had to entirely rewrite our test test suites. It’s more painful than a difficult work at first, but finally, we haven't spent too much time on this rewrite work.
Of course, we didn’t implement all atoum features, but we plan to update our tests in the future.

We did have a really basic usage of PHPUnit. The only thing that required much more work was the `@depends`[^2] capability of PHPUnit.
That was quite easy to change and brought some nice benefits: We now run all our tests from a fresh, out of the box GLPI environment.

Another issue was that atoum is much less permissive than PHPUnit per default, but this was not a real issue because we got many little things fixed (such as PHP notices…).

## 5. Did you have any advice for other people that would like to migrate to atoum from PHPUnit?

First of all, I’d advise people to write unit tests.

Most people I know actually use PHPUnit because they’ve always used it, so let’s give atoum a try, …) Well, at least try it, on a new project for example,
or just on a small part of your code.

## 6. You recently receive a price related to security, can you tell us more about it?

[Teclib](www.teclib.com) has been involved in a project to adapt it to match SoC (Security operation centre) requirements. The project had also been an opportunity to develop a REST API.

Being part of the OW2 Consortium community, GLPI [received][award-link] the [2017 Technology Council special prize][award-tweet] for its work on addressing security requirements but 
also the big working currently being made to modernise the framework. The jury has mentioned the implementation of unit tests and the switch from PHPUnit to atoum!

![Picture of award winning](https://pbs.twimg.com/media/DDRlUoSXgAAXBIp.jpg "Award winning")

## 7. If you have anything else to say, please feel free!

I’ve been involved in various projects (open source or not) for years. As many developers, I was not really aware of unit testing.
When I’ve started to write unit tests on my PHP applications, I chose PHPUnit (the only one I’d heard about at the time) but never really liked it.

When I’ve discovered atoum (I don’t remember exactly when, but that was far before the first semver release), I’ve immediately loved it. That was much
clearer to me to understand and write tests. I began to like that! …
I’ve used atoum in several closed source projects (even when the "frameworks" say to use something else), but also in [Galette](http://galette.eu)[^3],
which has unit tests powered by atoum since 2013.



## Final word
I would like to thank Johan and his team for this valuable feedback, it was really interesting to speak with end user of atoum. It's always challenging to see what a project
like this one can bring to other and I hope you also like it. If you use atoum on your project, we would be happy to hear some feedbacks about it, it's always important for us.


[^1]: The [announce](http://glpi-project.org/spip.php?breve374) in French
[^2]: Making possible for one test to depend on another, and to get the results of the first one as a parameter of the second one.
[^3]: Galette is an open source membership management web application towards non-profit organisations.
[GLPI]: http://glpi-project.org/
[announced-en]: http://glpi-project.org/spip.php?breve375
[award-link]: https://www.ow2con.org/bin/view/2017/Awards_Results
[award-tweet]: https://twitter.com/ow2/status/879440229593214977
