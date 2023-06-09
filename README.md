# RSGM CMS Connector
Connector to handle all API communication between Golds CMS and the front end websites

## Install

Add the github repository to your composer.json file: 

```
...
"repositories": [
        ...
        {
            "type": "vcs",
            "url": "https://github.com/RSGM-Sales/cms-connector.git"
        }
        ...
    ],
...
```

Run ```composer require rsgm-sales/cms-connector```

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

Run ```php artisan vendor:publish``` to publish the package files  
This will create a connector.php file in your /config folder, you can configure the site id and basic authentication parameters here

