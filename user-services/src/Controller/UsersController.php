<?php
declare(strict_types=1);

namespace App\Controller;

use App\Message\UserDataSavedEvent;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Users;

class UsersController extends AbstractController
{
    private $userService;
    private $messageBus;
    private $entityManager;

    public function __construct(UserService $userService, MessageBusInterface $messageBus, EntityManagerInterface $entityManager)
    {
        $this->userService = $userService;
        $this->messageBus = $messageBus;
        $this->entityManager = $entityManager;
    }

    public function createUser(Request $request): Response
   {
    $data = json_decode($request->getContent(), true);

    $existingUser = $this->entityManager->getRepository(Users::class)->findOneBy(['email' => $data['email']]);
    if ($existingUser) {
        return new JsonResponse(['error' => 'This email is already in use.'], Response::HTTP_BAD_REQUEST);
    }
    // Define constraints
    $constraints = [
        'firstName' => [
            new Assert\NotBlank(message: "Firstname should not be blank"),
            new Assert\NotNull()
        ],
        'lastName' => [
            new Assert\NotBlank(message: "Lastname should not be blank"),
            new Assert\NotNull()
        ],
        'email' => [
            new Assert\NotBlank(message: "Email should not be blank"),
            new Assert\Email(message: "Email value is not a valid email address."),
        ]
    ];

    // Validate data
    $validator = Validation::createValidator();
    $violations = $validator->validate($data, new Assert\Collection($constraints));

    // Check for violations
    if (count($violations) > 0) {
        $errors = [];
        foreach ($violations as $violation) {
            $errors[] = $violation->getMessage();
        }
        return $this->json($errors, 400);
    }

    // Proceed with user creation
    $userId = $this->userService->createUser($data['email'], $data['firstName'], $data['lastName']);
    $this->messageBus->dispatch(new UserDataSavedEvent($userId, $data['email'], $data['firstName'], $data['lastName']));

    return new JsonResponse(['message' => 'User created successfully'], Response::HTTP_CREATED);
   }


   
}

