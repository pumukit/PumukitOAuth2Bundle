# OAuth 2.0 Client

This package provides OAuth 2.0 support for the PHP League's [OAuth 2.0 Client](https://github.com/thephpleague/oauth2-client).

## Installation

To install, use composer:

```
composer require teltek/pumukit-oauth2-bundle
```

if not, add this to config/bundles.php

```
Pumukit\TemplateBundle\PumukitTemplateBundle::class => ['all' => true]
```

Then execute the following commands

```bash
php bin/console cache:clear
php bin/console cache:clear --env=prod
php bin/console assets:install
```

## Usage

Usage is the same as The League's OAuth client, using `Pumukit\OAuth2Bundle\Provider\Oam` as the provider.

### Authorization Code Flow

```php
$provider = new Pumukit\OAuth2Bundle\Provider\Oam(
    'clientId' => 'your client id',
    'clientSecret' => 'your client secret',
    'redirectUri' => 'your redirect uri',
    'urlAuthorize' => 'your url authorize',
    'urlAccessToken' => 'your url access token',
    'urlResourceOwnerDetails' => 'your url resource owner details',
]);

if (!isset($_GET['code'])) {
    $options['scope'] = array('Customer.Info','UserProfile.me');
    $authorizationUrl = $provider->getAuthorizationUrl($options);

    $_SESSION['oauth2state'] = $provider->getState();

    header('Location: '.$authorizationUrl);
    exit;

} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
    unset($_SESSION['oauth2state']);
    exit('Invalid state');
} else {

    try {
        $accessToken = $provider->getAccessToken('authorization_code',['code' => $_GET['code']]);

        $resourceOwner = $provider->getResourceOwner($accessToken);
        
        ...
    }  catch (IdentityProviderException $e) {
        exit($e->getMessage());
    }
```


### Scopes 

If you want send different scopes you must edit:

```php
$options['scope'] = array('Customer.Info','UserProfile.me');
```
