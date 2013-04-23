<?php

namespace Eo\AirbrakeBundle\Airbrake;

use Airbrake\Client as BaseClient;

class Client extends BaseClient
{
    /**
     * Class constructor
     * 
     * @param Eo\AirbrakeBundle\Airbrake\Configuration $configuration
     */
    public function __construct(Configuration $configuration)
    {
        parent::__construct($configuration);
    }
}