# Bitbucket PHP API Client

We present a modern [Bitbucket API 2.0](https://api.bitbucket.org/) client for PHP.

![Banner](https://user-images.githubusercontent.com/2829600/86968999-f9334a80-c164-11ea-9c20-2a4f9f9c898f.png)

<p align="center">
<a href="https://github.com/BitbucketPHP/Client/actions?query=workflow%3ATests"><img src="https://img.shields.io/github/actions/workflow/status/BitbucketPHP/Client/tests.yml?label=Tests&style=flat-square" alt="Build Status"></img></a>
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

This version supports [PHP](https://php.net) 8.1-8.5. To get started, simply require the project using [Composer](https://getcomposer.org). You will also need to install packages that "provide" [`psr/http-client-implementation`](https://packagist.org/providers/psr/http-client-implementation) and [`psr/http-factory-implementation`](https://packagist.org/providers/psr/http-factory-implementation).

### Standard Installation

```bash
$ composer require "bitbucket/client:^5.1" "guzzlehttp/guzzle:^7.9.2"
```

### Framework Integration

#### Laravel:

```bash
$ composer require "graham-campbell/bitbucket:^11.1"
```

We are decoupled from any HTTP messaging client by using [PSR-7](https://www.php-fig.org/psr/psr-7/), [PSR-17](https://www.php-fig.org/psr/psr-17/), [PSR-18](https://www.php-fig.org/psr/psr-18/), and [HTTPlug](https://httplug.io/). You can visit [HTTPlug for library users](https://docs.php-http.org/en/latest/httplug/users.html) to get more information about installing HTTPlug related packages. The framework integration [`graham-campbell/bitbucket`](https://github.com/GrahamCampbell/Laravel-Bitbucket) is by [Graham Campbell](https://github.com/GrahamCampbell).


## Usage

The main point of entry is the `Bitbucket\Client` class. Simply create a new instance of that, authenticate, and you're good to go! This client exposes Bitbucket API 2.0 endpoints through fluent resource classes. We'd recommend looking through the [Bitbucket documentation](https://developer.atlassian.com/cloud/bitbucket/rest/intro/), and also the [source code](https://github.com/BitbucketPHP/Client/tree/5.1/src) to get a full picture of what is available to use.

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

#### HTTP Basic

It is possible to authenticate using HTTP Basic credentials. For [Bitbucket API tokens](https://support.atlassian.com/bitbucket-cloud/docs/api-tokens/), use your Atlassian account email as the username and the API token as the password:

```php
$client = new Bitbucket\Client();

$client->authenticate(
    Bitbucket\Client::AUTH_HTTP_PASSWORD,
    'your-email@example.com',
    'your-api-token-here'
);
```

> Bitbucket API tokens are the long-term replacement for [app passwords](https://support.atlassian.com/bitbucket-cloud/docs/app-passwords/), which Bitbucket has deprecated. Do not use your Atlassian account password here.

#### JSON Web Token

Finally, we support logging in using JSON web tokens (JWTs). This method is required by some Bitbucket API endpoints, such as the addons API. Generate your JWT, perhaps using [lcobucci/jwt](https://github.com/lcobucci/jwt), then provide it as below:


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
    ->refs('stash-log-parser')
    ->branches();

$branches = $paginator->fetchAll($branchesClient, 'list');
```

Filtering and sorting parameters can be passed through the third argument to `fetchAll()`:

```php
$paginator = new Bitbucket\ResultPager($client);

$tagsClient = $client->repositories()
    ->workspaces('my-workspace')
    ->refs('my-repo')
    ->tags();

$tags = $paginator->fetchAll($tagsClient, 'list', [['q' => 'name ~ "v1"', 'sort' => '-name']]);
```

Bitbucket includes those query parameters in the `next` pagination URL, so subsequent pages preserve them automatically.

To list files from a specific branch or commit, use the source API with `ResultPager`. Directory listings include both `commit_file` and `commit_directory` entries, so filter the returned values by `type` if you only need files:

```php
$paginator = new Bitbucket\ResultPager($client);

$srcClient = $client->repositories()
    ->workspaces('my-workspace')
    ->src('my-repo');

$entries = $paginator->fetchAll($srcClient, 'show', ['main', '/', ['max_depth' => 10]]);
```


### Migrating Deprecated Bitbucket Endpoints

Bitbucket is removing or deprecating several cross-workspace endpoints. This client keeps the older methods available in v5.1, but marks them as deprecated where Bitbucket has published a supported replacement or removal notice.

| Deprecated usage | Replacement |
| --- | --- |
| `$client->currentUser()->listWorkspaces()` | `$client->currentUser()->workspaces()->list()` |
| `$client->currentUser()->listWorkspacePermissions()` | `$client->currentUser()->workspaces()->permissions($workspace)->show()` |
| `$client->currentUser()->listRepositoryPermissions()` | `$client->currentUser()->workspaces()->permissions($workspace)->repositories()->list()` |
| `$client->currentUser()->listTeamPermissions()` | Workspace APIs, where applicable |
| `$client->pullRequests()->list($selectedUser)` | `$client->workspaces($workspace)->pullRequests()->list($selectedUser)` |
| `$client->repositories()->list()` | `$client->repositories()->workspaces($workspace)->list()` |
| `$client->users($user)->repositories()->list()` | `$client->repositories()->workspaces($workspace)->list()` |
| `$client->snippets()->list()` | `$client->snippets()->workspaces($workspace)->list()` |

The replacement endpoints are usually workspace-scoped. If your application previously relied on cross-workspace results, enumerate the current user's workspaces and aggregate the workspace-scoped results in your application code.

```php
$paginator = new Bitbucket\ResultPager($client);

foreach ($paginator->fetchAll($client->currentUser()->workspaces(), 'list') as $workspaceAccess) {
    $workspace = $workspaceAccess['workspace']['slug'];

    $permissions = $paginator->fetchAll(
        $client->currentUser()->workspaces()->permissions($workspace)->repositories(),
        'list'
    );
}
```

The supported current user workspaces endpoint returns `workspace_access` values, not the old workspace object shape. The workspace details are available under the `workspace` key on each result.


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
