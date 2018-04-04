# Bitbucket API Client

We present a modern [Bitbucket](https://bitbucket.org/) API 2.0 client, by [Graham Campbell](https://github.com/GrahamCampbell).

This is strongly based on [php-github-api](https://github.com/KnpLabs/php-github-api) by [KnpLabs](https://github.com/KnpLabs). With this in mind, we now have **very similar** clients for:

* [GitHub](https://github.com/) - [knplabs/github-api](https://packagist.org/packages/knplabs/github-api) by [KnpLabs](https://github.com/KnpLabs/php-github-api).
* [GitLab](https://gitlab.com/) - [m4tthumphrey/php-gitlab-api](https://packagist.org/packages/m4tthumphrey/php-gitlab-api) by [Matt Humphrey](https://github.com/m4tthumphrey) et al.
* [Bitbucket](https://bitbucket.org/) - [bitbucket/client](https://packagist.org/packages/bitbucket/client) which is this package!


## Installation

This version requires [PHP](https://php.net) 7.1 or 7.2.

To get the latest version, simply require the project using [Composer](https://getcomposer.org):

```bash
$ composer require bitbucket/client
```


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

As of time of writing (Monday 4th April 2018), every endpoint available on the Bitbucket API 2.0 is also available through this PHP client. I'd recommend looking through the [Bitbucket documentation](https://developer.atlassian.com/bitbucket/api/2/reference/), and also the [generated documentation](https://bitbucketapi.github.io/Client/).


## Security

If you discover a security vulnerability within this package, please e-mail us at support@alt-three.com. All security vulnerabilities will be promptly addressed.


## License

Alt Three Storage is licensed under [The MIT License (MIT)](LICENSE).
