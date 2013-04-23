<?php

/*
 * This file is part of the EoAirbrakeBundle package.
 *
 * (c) Eymen Gunay <eymen@egunay.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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