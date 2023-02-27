# Bitbucket PHP API Client

We present a modern [Bitbucket API 2.0](https://api.bitbucket.org/) client for PHP.

![Banner](https://user-images.githubusercontent.com/2829600/86968999-f9334a80-c164-11ea-9c20-2a4f9f9c898f.png)

<p align="center">
<a href="https://github.com/BitbucketPHP/Client/actions?query=workflow%3ATests"><img src="https://img.shields.io/github/workflow/status/BitbucketPHP/Client/Tests?label=Tests&style=flat-square" alt="Build Status"></img></a>
<a href="https://github.styleci.io/repos/127466560"><img src="https://github.styleci.io/repos/127466560/shield" alt="StyleCI Status"></img></a>
<a href="LICENSE"><img src="https://img.shields.io/badge/license-MIT-brightgreen?style=flat-square" alt="Software License"></img></a>
<a href="https://packagist.org/packages/bitbucket/client"><img src="https://img.shields.io/packagist/dt/bitbucket/client?style=flat-square" alt="Packagist Downloads"></img></a>
<a href="https://github.com/BitbucketPHP/Client/releases"><img src="https://img.shields.io/github/release/BitbucketPHP/Client?style=flat-square" alt="Latest Version"></img></a>
</p>

This is strongly based on [php-github-api](https://github.com/KnpLabs/php-github-api) by [KnpLabs](https://github.com/KnpLabs). With this in mind, we now have **very similar** clients for:

* [GitHub](https://github.com/) - [knplabs/github-api](https://packagist.org/packages/knplabs/github-api) by [KnpLabs](https://github.com/KnpLabs/php-github-api).
* [GitLab](https://gitlab.com/) - [m4tthumphrey/php-gitlab-api](https://packagist.org/packages/m4tthumphrey/php-gitlab-api) by [Matt Humphrey](https://github.com/m4tthumphrey) et al.
* [Bitbucket](https://bitbucket.org/) - [bitbucket/client](https://packagist.org/packages/bitbucket/client) which is this package!

Check out the [change log](CHANGELOG.md), [releases](https://github.com/BitbucketPHP/Client/releases), [security policy](https://github.com/BitbucketPHP/Client/security/policy), [license](LICENSE), [code of conduct](.github/CODE_OF_CONDUCT.md), and [contribution guidelines](.github/CONTRIBUTING.md).


## Installation

This version supports [PHP](https://php.net) 7.4-8.2. To get started, simply require the project using [Composer](https://getcomposer.org). You will also need to install packages that "provide" [`psr/http-client-implementation`](https://packagist.org/providers/psr/http-client-implementation) and [`psr/http-factory-implementation`](https://packagist.org/providers/psr/http-factory-implementation).

### Standard Installation

```bash
$ composer require "bitbucket/client:^4.3" "guzzlehttp/guzzle:^7.5" "http-interop/http-factory-guzzle:^1.2"
```

### Framework Integration

#### Laravel:

```bash
$ composer require "graham-campbell/bitbucket:^9.0"
```

We are decoupled from any HTTP messaging client by using [PSR-7](https://www.php-fig.org/psr/psr-7/), [PSR-17](https://www.php-fig.org/psr/psr-17/), [PSR-18](https://www.php-fig.org/psr/psr-18/), and [HTTPlug](https://httplug.io/). You can visit [HTTPlug for library users](https://docs.php-http.org/en/latest/httplug/users.html) to get more information about installing HTTPlug related packages. The framework integration [`graham-campbell/bitbucket`](https://github.com/GrahamCampbell/Laravel-Bitbucket) is by [Graham Campbell](https://github.com/GrahamCampbell).


## Usage

The main point of entry is the `Bitbucket\Client` class. Simply create a new instance of that, authenticate, and you're good to go! As of time of writing (Tuesday 29th June 2020), every endpoint (excluding issue export and import, and various deprecated endpoints) available on the Bitbucket API 2.0 is also available through this PHP client. We'd recommend looking through the [Bitbucket documentation](https://developer.atlassian.com/bitbucket/api/2/reference/), and also the [source code](https://github.com/BitbucketPHP/Client/tree/3.0/src) to get a full picture of what is available to use.

### Authentication

There are three ways to authenticate our client:

#### OAuth 2 Token

The most common way to authenticate is using an OAuth 2 token. You will need to generate this by some means outside of the library, and then provide it as below:

```php
$client = new Bitbucket\Client();

$client->authenticate(
    Bitbucket\Client::AUTH_OAUTH_TOKEN,
    'your-token-here'
);
```

#### HTTP Password

It is possible to login using a username and password combination. This method is not recommended for production use, however you may find it useful never the less:

```php
$client = new Bitbucket\Client();

$client->authenticate(
    Bitbucket\Client::AUTH_HTTP_PASSWORD,
    'your-username-here',
    'your-password-here'
);
```

> If you have two-factor authentication enabled on your account, then you must use an [application password](https://support.atlassian.com/bitbucket-cloud/docs/app-passwords/).

#### JSON Web Token

Finally, we support logging in using JSON web tokens (JWTs). This method is exclusively required by some of Bitbucket's API endpoints, such as the addons API. Generate your JWT, perahps using [lcobucci/jwt](https://github.com/lcobucci/jwt/tree/3.3.2), then provide it as below:


```php
$client = new Bitbucket\Client();

$client->authenticate(
    Bitbucket\Client::AUTH_JWT,
    'your-jwt-here'
);
```

### Examples

In the following examples, `$client` will be an authenticated client, as above.

#### Example 1

It is possible to show basic information about the currently logged in user:

```php
$currentUser = $client->currentUser()->show();
```

#### Example 2

It is possible to grab a repository as follows:

```php
$repository = $client->repositories()
    ->workspaces('atlassian')
    ->show('stash-example-plugin');
```

#### Example 3

We support automatic pagination without you having to lift a finger. The following example gets all branches of a repository:

```php
$paginator = new Bitbucket\ResultPager($client);

$branchesClient = $client->repositories()
    ->workspaces('atlassianlabs')
    ->refs('stash-log-parser'])
    ->branches();

$branches = $paginator->fetchAll($branchesClient, 'list');
```


## Contributing

We will gladly receive issue reports and review and accept pull requests, in accordance with our [code of conduct](.github/CODE_OF_CONDUCT.md) and [contribution guidelines](.github/CONTRIBUTING.md)!

```
$ make install
$ make test
```


## Security

If you discover a security vulnerability within this package, please send an email to Graham Campbell at hello@gjcampbell.co.uk. All security vulnerabilities will be promptly addressed. You may view our full security policy [here](https://github.com/BitbucketPHP/Client/security/policy).


## License

Bitbucket PHP API Client is licensed under [The MIT License (MIT)](LICENSE).


## For Enterprise

Available as part of the Tidelift Subscription

The maintainers of `bitbucket/client` and thousands of other packages are working with Tidelift to deliver commercial support and maintenance for the open source dependencies you use to build your applications. Save time, reduce risk, and improve code health, while paying the maintainers of the exact dependencies you use. [Learn more.](https://tidelift.com/subscription/pkg/packagist-bitbucket-client?utm_source=packagist-bitbucket-client&utm_medium=referral&utm_campaign=enterprise&utm_term=repo)
