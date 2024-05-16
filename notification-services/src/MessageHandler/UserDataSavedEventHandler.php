<?php

namespace App\MessageHandler;

use App\Message\UserDataSavedEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class UserDataSavedEventHandler 
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(UserDataSavedEvent $event)
    {
        $this->logger->info(sprintf(
            'User data saved: User ID: %d, Email: %s, First Name: %s, Last Name: %s',
            $event->getUserId(),
            $event->getEmail(),
            $event->getFirstName(),
            $event->getLastName()
        ));
    }
}
