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
    public function __construct($container)
    {
        parent::__construct($container->getParameter('eo_airbrake.api_key'), array(
            'async'           => $container->getParameter('eo_airbrake.async'),
            'environmentName' => $container->get('kernel')->getEnvironment()
        ));
    }
}