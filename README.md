# RSGM CMD Connector
Connector to handle all API communication between Golds CMS en the front end websites

## Install

Add the github repository to your composer.json file:

```
...
"repositories": [
        ...
        {
            "type": "package",
            "package": {
                "name": "rsgm-sales/cms-connector",
                "version": "1.0.0",
                "source": {
                    "url": "git@github.com:RSGM-Sales/cms-connector.git",
                    "type": "git",
                    "reference": "master"
                }
            }
        }
        ...
    ],
...
```

Require the rsgm-sales/cms-connector package:

```
...
    "require": {
        ...
        "rsgm-sales/cms-connector": "1.0.0"
        ...
    },
...
```

Run ```composer update```

Add the package to autoload in your composer.json file:

```
...
    "autoload": {
        "psr-4": {
            "RSGMSales\\Connector\\": "vendor/rsgm-sales/cms-connector/src/"
        }
    },
...
```

Run ```composer dump-autoload```


Add the Connector service provider to the package service providers in the /config/app.php file:

```
...
    'providers' => [
        ...

        /*
         * Package Service Providers...
         */
         \RSGMSales\Connector\Providers\ConnectorProvider::class,
         ...
    ],
...
```


