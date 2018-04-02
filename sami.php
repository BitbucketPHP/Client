<?php

use Sami\Sami;
use Sami\RemoteRepository\GitHubRemoteRepository;
use Sami\Version\GitVersionCollection;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->exclude('tests')
    ->exclude('sami')
    ->exclude('vendor')
    ->in(__DIR__)
;

return new Sami($iterator, array(
    'title' => 'Bitbucket API Client',
    'build_dir' => __DIR__.'/sami/build',
    'cache_dir' => __DIR__.'/sami/cache',
    'remote_repository' => new GitHubRemoteRepository('BitbucketAPI/Client', __DIR__),
    'default_opened_level' => 2,
));
