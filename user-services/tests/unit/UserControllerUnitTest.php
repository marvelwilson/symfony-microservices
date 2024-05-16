<?php

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Messenger\MessageBusInterface;
use App\Controller\UsersController;
use App\Service\UserService;
use Symfony\Component\Dotenv\Dotenv;
use Doctrine\ORM\EntityManagerInterface;

class UserControllerUnitTest extends WebTestCase
{
    private $client;

    protected function setUp(): void
    {
        parent::setUp();  // Call parent's setUp method

        (new Dotenv())->loadEnv(dirname(__DIR__, 2).'/.env.test');  // Load test environment variables

        $this->client = static::createClient();  // Create the client
    }
    protected static function getKernelClass(): string
    {
        return \App\Kernel::class; // Adjust this to match your actual kernel class
    }

    public function testCreateUser()
{
    // Mock UserService
    $userService = $this->createMock(UserService::class);
    $userService->expects($this->once())
                ->method('createUser')
                ->with('test@example.com', 'John', 'Doe')
                ->willReturn(123);

    // Create EntityManagerInterface mock
    $entityManager = $this->createMock(EntityManagerInterface::class);

    // Create UsersController instance with real MessageBus
    $controller = new UsersController($userService, $this->client->getContainer()->get(MessageBusInterface::class), $entityManager);

    // Create a mock request
    $request = Request::create('/api/user', 'POST', [], [], [], [], json_encode([
        'email' => 'test@example.com',
        'firstName' => 'John',
        'lastName' => 'Doe'
    ]));

    // Call the method under test
    $response = $controller->createUser($request);

    // Assert response
    $this->assertInstanceOf(JsonResponse::class, $response);
    $responseData = json_decode($response->getContent(), true);
    $this->assertEquals('User created successfully', $responseData['message']);
    $this->assertEquals(201, $response->getStatusCode());
}
}
