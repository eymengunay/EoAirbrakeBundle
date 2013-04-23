<?php

namespace Eo\AirbrakeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SimulateController extends Controller
{
    /**
     * Index action
     */
    public function indexAction()
    {
        throw new \ErrorException("I've made a huge mistake");
    }
}
