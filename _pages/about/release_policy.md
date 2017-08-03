---
layout: static
title: Release policy
---

# Release policy
As said during the Forum PHP 2015, we should give our users a clear view of how/when we release atoum.

Here are some notes I have on this:
- **strictly stick to semver** (x++ if BC breaks, y++ for any new feature, z++ for any bug-fix)
- 1 release **every 6 weeks** (minor)
- release **ASAP for any bug** (patch)
- every **major is supported for 1 year** after the last minor/patch release
- after 1 year, **we may break BC if required** (and start a new major) whether the last major reached EOL or not
- next major may start before the previous one reaches EOL
- next minor/patch release source code lives on the master branch

## If 2 major releases are living side-by-side
- the oldest will have its own branch and the newest will live on the master branch
- bug-fixes will be backported
- features will be backported if possible

## Extensions (`atoum/*-extension`) / Stubs
- will be released in-sync with atoum to conform to breaking changes (new atoum major release)
- may be released at the same time (minor)
- released ASAP for any bug-fix

@atoum/rms feel free to comment on this, suggest new entry or fix some of them. Once we are OK with those rules, I'll write a blog post.



todo : add note about max 2 major living release supported


We should add a note on deprecations:

    Features may be marked as deprecated at any time in any minor version: this should at worst display a notice but the feature should be kept fully-functional. The notice must contain hints on the alternatives.
    Once we start the new major branch deprecated feature will be removed
