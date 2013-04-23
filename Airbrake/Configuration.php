<?php

namespace Eo\AirbrakeBundle\Airbrake;

use Airbrake\Configuration as BaseConfiguration;

class Configuration extends BaseConfiguration
{
    /**
     * Class constructor
     * 
     * @param Configuration $configuration
     */
    public function __construct($container)
    {
        parent::__construct($container->getParameter('eo_airbrake.api_key'), array(
            'async' => $container->getParameter('eo_airbrake.async')
        ));
    }
}