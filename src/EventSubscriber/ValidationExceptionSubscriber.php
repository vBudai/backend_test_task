<?php

namespace App\EventSubscriber;

use App\DTO\Response\ValidationErrorResponse;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\HttpKernel\Exception\HttpException;


class ValidationExceptionSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $this->unwrapException($event->getThrowable());

        if (!$exception instanceof ValidationFailedException) {
            return;
        }

        $response = new ValidationErrorResponse($exception->getViolations());

        $event->setResponse(new JsonResponse($response, $response->code));
    }

    protected function unwrapException(\Throwable $exception): \Throwable
    {
        return
            $exception instanceof HttpException &&
            $exception->getPrevious()
                ? $exception->getPrevious()
                : $exception;
    }
}