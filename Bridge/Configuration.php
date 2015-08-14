<?php

/*
 * This file is part of the EoAirbrakeBundle package.
 *
 * (c) Eymen Gunay <eymen@egunay.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eo\AirbrakeBundle\Bridge;

use Airbrake\Configuration as BaseConfiguration;

class Configuration extends BaseConfiguration
{
    /**
     * Class constructor
     *
     * @param Configuration $configuration
     */
    public function __construct($apiKey, $async, $env, $host, $secure, $projectRoot = null)
    {
        parent::__construct($apiKey, array(
            'async'           => $async,
            'environmentName' => $env,
            'host'            => $host,
            'secure'          => $secure,
            'port'            => $secure ? 443 : 80,
            'projectRoot'     => $projectRoot,
        ));
    }
}
