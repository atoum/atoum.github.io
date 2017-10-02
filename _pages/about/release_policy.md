---
layout: static
title: Release policy
---

# Release policy

Historically, atoum is a [rolling-release] software, it means without any versions. While this is very challenging 
because no regression must be introduced, this is not always comfortable for atoum's users that need versions, 
especially with a quality tool. That's why atoum uses [the semantic versioning specification][semver] too.

You can see the [latest atoum's version][release]. A [`CHANGELOG.md` file][changelog] is kept up-to-date.

atoum has 2 release managers. They apply the following rules:

1. If a bug has been fixed, a new version is released as soon as possible (it addresses the `z` in `x.y.z`);
2. Every 6 weeks, a new version is released containing the new features (it addresses the `y` in `x.y.z`);
3. If a backward-compatibility break is required, 2 new versions are released: a first one only with the new features
   and a second one only with the backward-compatibility break (it addresses the `x` in `x.y.z`).

Current release managers have been elected by the community and they are:

* [Ivan Enderlin][@Hywan],
* [Mikaël Randy][@mikaelrandy].

This team is [clearly identified][rm-team] on github.

### Deprecation

Features may be marked as deprecated at any time in any minor version: this should at worst display a notice
but the feature should be kept fully functional. The notice must contain hints on the alternatives. Once we start
the new major branch deprecated features will be removed.

## Support of previous major version

We will support a previous major version until *one* year after the *last minor/patch* release.

### Multiple major releases living side-by-side

When we release a new major version, we only support the current and the previous major version, but not more. To handle that,
we follow this process:
* the oldest major version will have its own branch and the newest will live on the master branch;
* bug-fixes will be backported;
* features will be backported if possible or asked.

But, for any reason next major may start before the previous one reaches EOL.

In any case next minor/patch release source code lives on the master branch.

## Semver & rolling-release
atoum follow semver, but as said also [rolling release][reolling-release] principle. So **the *master* branch is considered as stable** and can be directly used without any issue and represent the latest stable version. 

## Extensions
The officially supported extensions[^1] has a different release policy. They are released when they are ready:
* if there is any BC break in atoum, they will be released in-sync with atoum for new atoum major release;
* may be released at the same time (minor);
* released as soon as possible for any bug fix.




If you get any questions don't hesitate to [contact us]({% link _pages/about/contact.md %})!.

[^1]: the official extension stands on github repository `atoum/*-extension`

[rolling-release]: https://en.wikipedia.org/wiki/Rolling_release
[semver]: http://www.semver.org/
[rm-team]: https://github.com/orgs/atoum/teams/rms/members
[@Hywan]: https://github.com/Hywan
[@mikaelrandy]: https://github.com/mikaelrandy
[changelog]: /atoum/atoum/#/blob/master/CHANGELOG.md
[release]: /atoum/atoum/#/releases/latest
