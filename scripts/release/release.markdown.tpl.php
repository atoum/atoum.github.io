---
layout: post
title: "Release <?= $newRevision ?>"
date: <?= $publicationDate ?> 10:00:00
author: "@<?= $author ?>"
categories: release
---

We are proud to announce the availability of atoum [<?= $newRevision ?>][milestone]!

## Stats

* <?= $commits ?> [commits][commits],
* <?= $fileChanged ?> files changed,
* <?= $contributors ?> [contributors][contributors],
* <?= $numberOfFeatures ?> [new features][changelog],
* <?= $numberOfBugFix ?> [bug fix][changelog].

## What's new

----- release message to help redact this -----
<?= $releaseMessage ?>
----- release message to help redact this -----

TODO : INTRODUCTION

### Deprecations and breaking changes

TODO

#### Runtime

TODO

#### Reports

TODO

#### Assertions

TODO

### New features and bug fixes

TODO

### Extensions

TODO

### Documentation

TODO

## Links

* [Milestone][milestone],
* [Release][release],
* [Changelog][changelog],
* [Commits][commits].

[milestone]: <?= $link['milestone']; ?>

[release]: <?= $link['release']; ?>

[changelog]: <?= $link['changelog']; ?>

[commits]: <?= $link['commits']; ?>

[contributors]: https://github.com/orgs/atoum/teams/contributors
