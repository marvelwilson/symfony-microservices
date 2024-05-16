<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Users; // Assuming User is your entity
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Dotenv\Dotenv;

class UserControllerIntegrationTest extends WebTestCase
{
    private $client;

    protected function setUp(): void
    {
        parent::setUp();
        (new Dotenv())->loadEnv(dirname(__DIR__, 2).'/.env.test');
        $this->client = static::createClient();
    }

    protected static function getKernelClass(): string
    {
        return \App\Kernel::class;
    }

    public function testCreateUser()
    {
        // Get the entity manager
        $entityManager = $this->client->getContainer()->get('doctrine')->getManager();

        // Clear existing data
        $entityManager->createQuery('DELETE FROM App\Entity\Users')->execute();

        // Make a request to the controller with invalid data (missing required fields)
        $this->client->request('POST', '/api/user', [], [], [], json_encode([
            'email' =>'',
            'firstName' => 'John',
            'lastName' => 'Doe'
        ]));

        // Assert that the response status code is 400 (Bad Request)
        $this->assertEquals(400, $this->client->getResponse()->getStatusCode());

        // Make a request to the controller with valid data
        $this->client->request('POST', '/api/user', [], [], [], json_encode([
            'email' => 'test@example.com',
            'firstName' => 'John',
            'lastName' => 'Doe'
        ]));

        // Assert that the response status code is 201 (Created)
        $this->assertEquals(201, $this->client->getResponse()->getStatusCode());

        // Retrieve the user from the database
        $userRepository = $entityManager->getRepository(Users::class);
        $user = $userRepository->findOneBy(['email' => 'test@example.com']);

        // Assertions
        $this->assertNotNull($user);
        $this->assertSame('John', $user->getFirstName());
        $this->assertSame('Doe', $user->getLastName());
    }
}

