<?php

/*
 * This file is part of the EoAirbrakeBundle package.
 *
 * (c) Eymen Gunay <eymen@egunay.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eo\AirbrakeBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * NotifierExtension
 */
class NotifierExtension extends \Twig_Extension
{
    /**
     * @var array $options Array of default options that can be overriden with getters and in the construct.
     */
    protected $options = array();

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * Class constructor
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

/**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('airbrake_notifier', [$this, 'getAirbrakeNotifier'], array(
                'is_safe' => array('html'),
            ))
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getAirbrakeNotifier()
    {
        return $this->container->get('templating')->render('EoAirbrakeBundle:Extension:notifier.html.twig', array(
            'host' => $this->container->getParameter('eo_airbrake.host'),
            'api_key' => $this->container->getParameter('eo_airbrake.api_key')
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'airbrake_notifier_extension';
    }
}
