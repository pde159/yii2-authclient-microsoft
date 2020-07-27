# yii2-authclient-microsoft

Yii2 authclient for Microsoft 365/Azure

## Installation

With Composer :


```sh
composer require pde159/yii2-authclient-microsoft
```

or add to "require" section to composer.json

```sh
"pde159/yii2-authclient-microsoft": "*"
```

## Usage

First create you Application via Microsoft Azure Portal and configure :

- a redirect URI
- a secret key
- set to `all tenant` for multitenant availability

And add the Oauth2 client to your Yii2 configuration `component` section

```php
'components' => [
    'authClientCollection' => [
        'class'   => \yii\authclient\Collection::className(),
        'clients' => [
            'microsoft' => [
                'class'         => 'pde159\authclient\Microsoft',
                'returnUrl'     => 'http://localhost/user/login',
                'clientId'      => 'clientIDyoudefinedInAzurePortal',
                'clientSecret'  => 'SecretyoucratedinAzurePortal',
            ],
            ...
        ],
    ],
    ...
]
```