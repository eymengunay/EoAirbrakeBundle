<?php

/*
 * This file is part of the EoAirbrakeBundle package.
 *
 * (c) Eymen Gunay <eymen@egunay.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eo\AirbrakeBundle\Controller;

use Eo\AirbrakeBundle\Exception\SimulateException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SimulateController extends Controller
{
    /**
     * Index action
     */
    public function indexAction()
    {
        throw new SimulateException("I've made a huge mistake");
    }
}
