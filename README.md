# EoAirbrakeBundle

[Airbrake.io](https://airbrake.io) integration for Symfony2.

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
All configuration values are required to use the bundle.

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
    api_key: YOUR-API-KEY
    # By default, the notifier uses a socket connection to send the exceptions to Airbrake, 
    # which WON'T wait for a response back from the server. 
    # If this is not derisable for your application, you can pass async: false 
    # and the notifier will send an syncronous notification using cURL.
    async: true
```

## Usage
Once configured, bundle will automatically send exceptions/errors to airbrake server.

## License
This bundle is under the MIT license. See the complete license in the bundle:
```
Resources/meta/LICENSE
```

## Reporting an issue or a feature request
Issues and feature requests related to this bundle are tracked in the Github issue tracker https://github.com/eymengunay/EoAirbrakeBundle/issues.
