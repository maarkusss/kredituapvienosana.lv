# Goodwall routes protection

Package provides functionality to restrict certain routes for the specific whitelist of IP addresses.
Developer needs to manually restrict routes by editing project's source code.
This is achieved by wrapping protectable routes with middleware introduced in this package.

### Requirements

The package relies on Laravel framework, so it is a must to have Laravel installed before adding the package.

### Installation

Only if you have installed the package manually (and have not required that from remote private repo), 
add the new namespace to composer.json autoload psr-4 section:
"Goodday\\Goodwall\\": "packages/goodwall/src"
so that your psr-4 section looks approximately like this:

```
"psr-4": {
    "App\\": "app/",
    "Goodday\\Goodwall\\": "packages/goodwall/src"
},
```

Add `\Goodday\Goodwall\Providers\GoodwallServiceProvider::class` to the list of providers in `config/app.php`

After adding the package to your project, run migrations: 

```bash
$ php artisan migrate
```

Optionally, you can run vendor:publish to publish config files.

To access the API commands remotely, please add the following keys in your .env file:

```
GOODWALL_ENABLED=true
GOODWALL_API_KEY=
GOODWALL_SECRET_KEY=
```

### Usage

To restrict a route, wrap it with `Goodday\Goodwall\Http\Middleware\BehindGoodwall::class` 
middleware in your routes/web.php and/or other routes files. This should look like this:

```
Route::group([
    'middleware' => \Goodday\Goodwall\Http\Middleware\BehindGoodwall::class,
], function () {
    Route::get('/', function() {
        return 'Only accessible by whitelisted IPs';
    });
});
```

### Deactivation

Should you ever need to deactivate the functionality, just set `GOODWALL_ENABLED=false` in your .env file
