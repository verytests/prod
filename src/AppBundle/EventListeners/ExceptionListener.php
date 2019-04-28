<?php

namespace AppBundle\EventListeners;

use AppBundle\Entity\Log;
use AppBundle\Services\LogService;
use AppBundle\Utils\LogUtil;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ExceptionListener
{
    private $logger;
    private $urlGenerator;

    public function __construct(LogService $logger, UrlGeneratorInterface $urlGenerator)
    {
        $this->logger = $logger;
        $this->urlGenerator = $urlGenerator;
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        $this->logger->error(
           LogUtil::constructData( LogUtil::CRITICAL_SERVER_ERROR,
               [
                   'Message' => $exception->getMessage(),
                   'Code' => $exception->getCode(),
                   'Trace' => $exception->getTrace()
               ]),
        Log::SOURCE_GLOBAL);
    }
}
