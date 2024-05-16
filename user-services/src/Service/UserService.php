<?php

namespace App\Service;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;

class UserService
{
    private $entityManager;
    private $userRepository;

    public function __construct(EntityManagerInterface $entityManager, UsersRepository $userRepository)
    {
        $this->entityManager = $entityManager;
        $this->userRepository = $userRepository;
    }

    public function createUser(string $email, string $firstName, string $lastName): int
    {
        $user = new Users();
        $user->setEmail($email);
        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user->getId();
    }
}
