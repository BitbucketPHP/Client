# Bitbucket API Client

We present a modern [Bitbucket](https://bitbucket.org/) API 2.0 client, by [Graham Campbell](https://github.com/GrahamCampbell).

![Banner](https://user-images.githubusercontent.com/2829600/71563802-86e2fe80-2a8d-11ea-9f03-1cc0b6517210.png)

<p align="center">
<a href="https://github.styleci.io/repos/127466560"><img src="https://github.styleci.io/repos/127466560/shield" alt="StyleCI Status"></img></a>
<a href="https://github.com/BitbucketAPI/Client/actions?query=workflow%3ATests"><img src="https://img.shields.io/github/workflow/status/BitbucketAPI/Client/Tests?style=flat-square" alt="Build Status"></img></a>
<a href="https://scrutinizer-ci.com/g/BitbucketAPI/Client"><img src="https://img.shields.io/scrutinizer/g/BitbucketAPI/Client?style=flat-square" alt="Quality Score"></img></a>
<a href="LICENSE"><img src="https://img.shields.io/badge/license-MIT-brightgreen?style=flat-square" alt="Software License"></img></a>
<a href="https://github.com/BitbucketAPI/Client/releases"><img src="https://img.shields.io/github/release/BitbucketAPI/Client?style=flat-square" alt="Latest Version"></img></a>
</p>

This is strongly based on [php-github-api](https://github.com/KnpLabs/php-github-api) by [KnpLabs](https://github.com/KnpLabs). With this in mind, we now have **very similar** clients for:

* [GitHub](https://github.com/) - [knplabs/github-api](https://packagist.org/packages/knplabs/github-api) by [KnpLabs](https://github.com/KnpLabs/php-github-api).
* [GitLab](https://gitlab.com/) - [m4tthumphrey/php-gitlab-api](https://packagist.org/packages/m4tthumphrey/php-gitlab-api) by [Matt Humphrey](https://github.com/m4tthumphrey) et al.
* [Bitbucket](https://bitbucket.org/) - [bitbucket/client](https://packagist.org/packages/bitbucket/client) which is this package!

Feel free to check out the [change log](CHANGELOG.md), [releases](https://github.com/BitbucketAPI/Client/releases), [security policy](https://github.com/BitbucketAPI/Client/security/policy), [license](LICENSE), [code of conduct](.github/CODE_OF_CONDUCT.md), and [contribution guidelines](.github/CONTRIBUTING.md).


## Installation

This version requires [PHP](https://php.net) 7.1-7.4.

To get the latest version, simply require the project using [Composer](https://getcomposer.org). You will also need to install packages that "provide" [`psr/http-client-implementation`](https://packagist.org/providers/psr/http-client-implementation) and [`psr/http-factory-implementation`](https://packagist.org/providers/psr/http-factory-implementation).

### PHP 7.1+:

```bash
$ composer require bitbucket/client:^3.0 php-http/guzzle6-adapter:^2.0.1 http-interop/http-factory-guzzle:^1.0
```

### PHP 7.2+:

```bash
$ composer require bitbucket/client:^3.0 guzzlehttp/guzzle:^7.0.1 http-interop/http-factory-guzzle:^1.0
```

### Laravel 6+:

```bash
$ composer require graham-campbell/bitbucket:^7.0 guzzlehttp/guzzle:^7.0.1 http-interop/http-factory-guzzle:^1.0
```

We are decoupled from any HTTP messaging client with help by [HTTPlug](http://httplug.io). You can visit [HTTPlug for library users](https://docs.php-http.org/en/latest/httplug/users.html) to get more information about installing HTTPlug related packages. [`graham-campbell/bitbucket`](https://github.com/GrahamCampbell/Laravel-Bitbucket) is also maintained by [Graham Campbell](https://github.com/GrahamCampbell).


## Usage

The main point of entry is the `Bitbucket\Client` class. Simply create a new instance of that, authenticate, and you're good to go! As of time of writing (Tuesday 29th June 2020), every endpoint (excluding issue export and import, and various deprecated endpoints) available on the Bitbucket API 2.0 is also available through this PHP client. We'd recommend looking through the [Bitbucket documentation](https://developer.atlassian.com/bitbucket/api/2/reference/), and also the [source code](https://github.com/BitbucketAPI/Client/tree/3.0/src) to get a full picture of what is available to use.

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


## Security

If you discover a security vulnerability within this package, please send an email to Graham Campbell at graham@alt-three.com. All security vulnerabilities will be promptly addressed. You may view our full security policy [here](https://github.com/BitbucketAPI/Client/security/policy).


## License

Bitbucket API Client is licensed under [The MIT License (MIT)](LICENSE).


## For Enterprise

Available as part of the Tidelift Subscription

The maintainers of `bitbucket/client` and thousands of other packages are working with Tidelift to deliver commercial support and maintenance for the open source dependencies you use to build your applications. Save time, reduce risk, and improve code health, while paying the maintainers of the exact dependencies you use. [Learn more.](https://tidelift.com/subscription/pkg/packagist-bitbucket-client?utm_source=packagist-bitbucket-client&utm_medium=referral&utm_campaign=enterprise&utm_term=repo)
