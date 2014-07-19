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

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

/**
 * NotifierExtension
 */
class NotifierExtension extends \Twig_Extension
{
    /**
     * @var EngineInterface
     */
    protected $templating;

    /**
     * Class constructor
     *
     * @param EngineInterface $templating
     * @param string          $host
     * @param string          $apiKey
     */
    public function __construct(EngineInterface $templating, $host, $apiKey)
    {
        $this->templating = $templating;
        $this->host       = $host;
        $this->apiKey     = $apiKey;
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return array(
            'airbrake_notifier' => new \Twig_Function_Method($this, 'getAirbrakeNotifier', array(
                'is_safe' => array('html'),
            ))
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getAirbrakeNotifier()
    {
        return $this->templating->render('EoAirbrakeBundle:Extension:notifier.html.twig', array(
            'host'    => $this->host,
            'api_key' => $this->apiKey
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
