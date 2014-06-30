# EoAirbrakeBundle

[![Latest Stable Version](https://poser.pugx.org/eo/airbrake-bundle/v/stable.png)](https://packagist.org/packages/eo/airbrake-bundle)
[![Dependencies Status](https://www.versioneye.com/php/eo:airbrake-bundle/dev-master/badge.png)](https://www.versioneye.com/php/eo:airbrake-bundle)

[Airbrake.io](https://airbrake.io) & [Errbit](https://github.com/errbit/errbit) integration for Symfony2.

## Prerequisites
This version of the bundle requires Symfony 2.1+

## Installation

### Step 1: Download EoAirbrakeBundle using composer
Add EoAirbrakeBundle in your composer.json:

```
{
    "require": {
        "eo/airbrake-bundle": "dev-master"
    }
}
```

Now tell composer to download the bundle by running the command:

```
$ php composer.phar update eo/airbrake-bundle
```

Composer will install the bundle to your project's vendor/eo directory.

### Step 2: Enable the bundle
Enable the bundle in the kernel:

```
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Eo\AirbrakeBundle\EoAirbrakeBundle(),
    );
}
```

### Step 3: Configure the EoAirbrakeBundle
Now that you have properly installed and enabled EoAirbrakeBundle, the next step is to configure the bundle to work with the specific needs of your application.

Add the following configuration to your `config.yml` file

```
# app/config/config.yml
eo_airbrake:
    api_key: YOUR-API-KEY
```

### Step 4 (Optional): Add EoAirbrakeBundle routing to simulate an error exception:
If you want to simulate an exception and test your configuration you can add the following route in your application.

```
# app/config/routing.yml
eo_airbrake_simulate:
    pattern: /airbrake/simulate
    defaults:  { _controller:  EoAirbrakeBundle:Simulate:index }
```
You will now be able to access the example controller from: `http://domain.tld/airbrake/simulate`


## Configuration reference

```
eo_airbrake:
    # Omit this key if you need to enable/disable the bundle temporarily 
    # If not given, this bundle will ignore all exceptions and won't send any data to remote.
    api_key: YOUR-API-KEY

    # By default, the notifier uses a socket connection to send the exceptions to Airbrake, 
    # which WON'T wait for a response back from the server. 
    # If this is not derisable for your application, you can pass async: false 
    # and the notifier will send an syncronous notification using cURL.
    async: true

    # If you are using your own hosted implementation of 
    # Airbrake (such as Errbit) you will have to specify your custom host name.
    host: errbit.example.com

    # You might want to ignore some exceptions such as http not found, access denied etc.
    # By default this bundle ignores all HttpException instances. (includes HttpNotFoundException, AccessDeniedException)
    # To log all exceptions leave this array empty.
    ignored_exceptions: ["Symfony\Component\HttpKernel\Exception\HttpException"]

    # If you want to force override of whether or not to use SSL you can set secure to true/false whether or not to use SSL you can set secure to true/false
    # By default secure is set to true
    secure: true
```

## Usage
Once configured, bundle will automatically send exceptions/errors to airbrake server.

## Logging javascript errors
EoAirbrakeBundle includes a twig extension for airbrake javascript notifier. To start logging exceptions on client side you have to add `{{ airbrake_notifier() }}` function in your base template:
```
<!doctype html>
<html lang="en">
    <head>
        <title>Hello World</title>
        <!-- Airbrake notifier -->
        {{ airbrake_notifier() }}
    </head>
...
```

## License
This bundle is under the MIT license. See the complete license in the bundle:
```
Resources/meta/LICENSE
```

## Reporting an issue or a feature request
Issues and feature requests related to this bundle are tracked in the Github issue tracker https://github.com/eymengunay/EoAirbrakeBundle/issues.
