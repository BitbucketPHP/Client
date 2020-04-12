# Bitbucket API Client

We present a modern [Bitbucket](https://bitbucket.org/) API 2.0 client, by [Graham Campbell](https://github.com/GrahamCampbell).

![Banner](https://user-images.githubusercontent.com/2829600/71563802-86e2fe80-2a8d-11ea-9f03-1cc0b6517210.png)

<p align="center">
<a href="https://styleci.io/repos/127466560"><img src="https://styleci.io/repos/127466560/shield" alt="StyleCI Status"></img></a>
<a href="https://github.com/BitbucketAPI/Client/actions?query=workflow%3ATests"><img src="https://img.shields.io/github/workflow/status/BitbucketAPI/Client/Tests?style=flat-square" alt="Build Status"></img></a>
<a href="https://scrutinizer-ci.com/g/BitbucketAPI/Client"><img src="https://img.shields.io/scrutinizer/g/BitbucketAPI/Client.svg?style=flat-square" alt="Quality Score"></img></a>
<a href="LICENSE"><img src="https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square" alt="Software License"></img></a>
<a href="https://github.com/BitbucketAPI/Client/releases"><img src="https://img.shields.io/github/release/BitbucketAPI/Client.svg?style=flat-square" alt="Latest Version"></img></a>
</p>

This is strongly based on [php-github-api](https://github.com/KnpLabs/php-github-api) by [KnpLabs](https://github.com/KnpLabs). With this in mind, we now have **very similar** clients for:

* [GitHub](https://github.com/) - [knplabs/github-api](https://packagist.org/packages/knplabs/github-api) by [KnpLabs](https://github.com/KnpLabs/php-github-api).
* [GitLab](https://gitlab.com/) - [m4tthumphrey/php-gitlab-api](https://packagist.org/packages/m4tthumphrey/php-gitlab-api) by [Matt Humphrey](https://github.com/m4tthumphrey) et al.
* [Bitbucket](https://bitbucket.org/) - [bitbucket/client](https://packagist.org/packages/bitbucket/client) which is this package!


## Installation

This version requires [PHP](https://php.net) 7.1-7.4.

To get the latest version, simply require the project using [Composer](https://getcomposer.org). You will need to install any package that "provides" `php-http/client-implementation`. Most users will want:

```bash
$ composer require bitbucket/client php-http/guzzle6-adapter:^2.0
```

There is also a Laravel bridge for this package: [`graham-campbell/bitbucket`](https://github.com/GrahamCampbell/Laravel-Bitbucket).

## Usage

The main point of entry is the `Bitbucket\Client` class. Simply create a new instance of that, and you're good to go!

Practically, you will also want to set authentication details before calling any of the endpoint, however, this is not required to call endpoints for which authentication is not needed. We support logging in with an OAuth2 token, or with a username and password.

```php
<?php

use Bitbucket\Client;

$c = new Client();

$c->authenticate(Client::AUTH_OAUTH_TOKEN, 'your-token-here');
// $c->authenticate(Client::AUTH_HTTP_PASSWORD, 'your-username', 'your-password');

var_dump($c->currentUser()->show());
```

As of time of writing (Saturday 29th June 2019), every endpoint (excluding issue export and import) available on the Bitbucket API 2.0 is also available through this PHP client. I'd recommend looking through the [Bitbucket documentation](https://developer.atlassian.com/bitbucket/api/2/reference/), and also the [generated documentation](https://bitbucketapi.github.io/Client/).


## Security

If you discover a security vulnerability within this package, please send an email to Graham Campbell at graham@alt-three.com. All security vulnerabilities will be promptly addressed. You may view our full security policy [here](https://github.com/BitbucketAPI/Client/security/policy).


## License

Bitbucket API Client is licensed under [The MIT License (MIT)](LICENSE).


## For Enterprise

Available as part of the Tidelift Subscription

The maintainers of `bitbucket/client` and thousands of other packages are working with Tidelift to deliver commercial support and maintenance for the open source dependencies you use to build your applications. Save time, reduce risk, and improve code health, while paying the maintainers of the exact dependencies you use. [Learn more.](https://tidelift.com/subscription/pkg/packagist-bitbucket-client?utm_source=packagist-bitbucket-client&utm_medium=referral&utm_campaign=enterprise&utm_term=repo)
