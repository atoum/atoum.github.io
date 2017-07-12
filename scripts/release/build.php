<?php

include 'vendor/autoload.php';

// https://github.com/milo/github-api/wiki/OAuth-token-obtaining
// https://github.com/milo/github-api/wiki/Pagination
// https://developer.github.com/v3/repos/commits/

use Milo\Github;

// greating
echo 'Great, if you are here is to publish a new release, so the team have made a great work!', PHP_EOL;
echo 'So, just aswer to some questions', PHP_EOL;

// taking data
$currentRevision = readline('Last revision: ');
$newRevision = readline('New revision: ');
$author = readline('Your pseudo: ');
$publicationDate = readline('Publication date for the news(YYYY-MM-DD): ');

$file = __DIR__ . '/../../_posts/' . $publicationDate . '-release-' . str_replace('.', '-', $newRevision) . '.markdown';

// get data from github about the release
$api = new Github\Api;
$response = $api->get('/repos/:owner/:repo/releases/tags/:tag', [
	'owner' => 'atoum',
	'repo' => 'atoum',
    'tag' => $newRevision,
]);
$results = $api->decode($response);

$link = [
	'release' => $results->html_url,
];

$releaseMessage = $results->body;
$releaseDate = explode('T', $results->published_at);

$bugsAndFeatures = explode('# Bugfix', $releaseMessage);
preg_match_all('#\* .*\n#', $bugsAndFeatures[0], $matches);
$numberOfFeatures = count($matches[0]);
if (isset($bugsAndFeatures[1]))
{
	preg_match_all('#\* .*\n#', $bugsAndFeatures[1], $matches);
	$numberOfBugFix = count($matches[0]);
}


// get data from github about evolution
$response = $api->get('/repos/:owner/:repo/compare/:base...:head', [
	'owner' => 'atoum',
    'repo' => 'atoum',
    'base' => $currentRevision,
	'head' => $newRevision,
]);
$results = $api->decode($response);

$link['milestone'] = 'https://github.com/atoum/atoum/issues?q=milestone%3A' . $newRevision . '+is%3Aclosed';
$link['changelog'] = 'https://github.com/atoum/atoum/blob/master/CHANGELOG.md#' . str_replace('.', '', $newRevision) . '---' . $releaseDate[0];
$link['commits'] = $results->html_url;

$commits = $results->total_commits;

$authors = array();
foreach ($results->commits as $commit)
{
	if (!empty($commit->author->login))
	{
		$authors[] = $commit->author->login;
	}
	elseif (!empty($commit->commit->author->email))
	{
		$authors[] = $commit->commit->author->email;
	}
	else
	{
		$authors[] = $commit->commiter->login;
	}
}

$authors = array_unique($authors);
$contributors = count($authors);
$fileChanged = count($results->files);

ob_start();
include __DIR__ . '/release.markdow.tpl.php';
$content = ob_get_flush();
file_put_contents($file, $content);

echo 'Ready, just edit the file : "', $file, '"', PHP_EOL;
