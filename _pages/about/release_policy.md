---
layout: static
title: Release policy
---

# Release policy

This project has several rules about release:
* this project follows [semver](http://semver.org/) for the version number
* release a new version **every 6 weeks** (minor), when it's relevant
* release **as soon as possible for any bug** (patch).

### Deprecation

Features may be marked as deprecated at any time in any minor version: this should at worst display a notice
but the feature should be kept fully functional. The notice must contain hints on the alternatives. Once we start
the new major branch deprecated features will be removed.

## Support of previous major version

We try to support a previous major version until *one* year after the *last minor/patch* release.

### Multiple major releases living side-by-side

When we release a new major version, we only support the current and the previous major version, but not more. To handle that,
we follow this process:
* the oldest major version will have its own branch and the newest will live on the master branch
* bug-fixes will be backported
* features will be backported if possible or asked.

But, for any reason next major may start before the previous one reaches EOL.

In any case next minor/patch release source code lives on the master branch.

## Semver & rolling-release
atoum follow semver, but also [rolling release](https://en.wikipedia.org/wiki/Rolling_release) principle. So
the *master* branch is considered as stable and can be directly used without any issue and represent the latest stable version. 

## Extensions
The officially supported extension[^1] has a different release policy. It's more released when it's ready:
* if there is BC break, will be released in-sync with atoum for new atoum major release
* may be released at the same time (minor)
* released as soon as possible for any bug fix.

## Teams
The team leading the release is [clearly identified](https://github.com/orgs/atoum/teams/rms/members) on github.    

[^1]: the official extension stands on github repository `atoum/*-extension`
