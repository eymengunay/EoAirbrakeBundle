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

use Eo\AirbrakeBundle\Airbrake\Client;
use Symfony\Component\HttpKernel\Exception\HttpException;
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
     * Class constructor
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();
        
        if ($exception instanceof HttpException) {
            return;
        }
        
        $this->client->notifyOnException($exception);
        error_log($exception->getMessage().' in: '.$exception->getFile().':'.$exception->getLine());
    }
}
