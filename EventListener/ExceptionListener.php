<?php

/*
 * This file is part of the EoAirbrakeBundle package.
 *
 * (c) Eymen Gunay <eymen@egunay.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eo\AirbrakeBundle\EventListener;

use Eo\AirbrakeBundle\Bridge\Client;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

/**
 * Eo\AirbrakeBundle\EventListener\ExceptionListener
 */
class ExceptionListener
{
    /**
     * @var Airbrake\Client
     */
    protected $client;

    /**
     * @var array
     */
    protected $ignoredExceptions;

    /**
     * Class constructor
     * @param Client $client
     */
    public function __construct(Client $client, array $ignoredExceptions = array())
    {
        $this->client = $client;
        $this->ignoredExceptions = $ignoredExceptions;
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        foreach ($this->ignoredExceptions as $ignoredException) {
            if ($exception instanceof $ignoredException) {
                return;
            }
        }

        $this->client->notifyOnException($exception);
        error_log($exception->getMessage().' in: '.$exception->getFile().':'.$exception->getLine());
    }
}
