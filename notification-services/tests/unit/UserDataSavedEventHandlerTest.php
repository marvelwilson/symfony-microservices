<?php


use PHPUnit\Framework\TestCase;
use App\Message\UserDataSavedEvent;
use App\MessageHandler\UserDataSavedEventHandler;
use Psr\Log\LoggerInterface;
class UserDataSavedEventHandlerTest extends TestCase
{
    public function testInvoke(): void
    {
        // Create a mock instance of LoggerInterface
        $loggerMock = $this->createMock(LoggerInterface::class);
        
        // Create an instance of UserDataSavedEvent
        $userDataSavedEvent = new UserDataSavedEvent(1, 'test@example.com', 'John', 'Doe');
        
        // Set up expectations for the logger mock
        $loggerMock->expects($this->once())
            ->method('info')
            ->with($this->stringContains('User data saved'));
        
        // Create an instance of UserDataSavedEventHandler with the mock logger
        $handler = new UserDataSavedEventHandler($loggerMock);
        
        // Call the invoke method (handling the event)
        $handler($userDataSavedEvent);
    }
}
