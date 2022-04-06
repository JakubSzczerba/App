<?php

declare(strict_types=1);

namespace App\DataFixtures;

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserFixtures
 * @package App\DataFixtures
 */
class UserFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;
    /**
     * @var EntityManager
     */
    private $entityManager;
    /**
     * UserFixtures constructor.
     * @param UserPasswordEncoderInterface $encoder Password encoder instance
     */
    public function __construct(UserPasswordEncoderInterface $encoder, EntityManagerInterface $entityManager) {
        $this->encoder = $encoder;
        $this->entityManager = $entityManager;
    }

    public function load(ObjectManager $manager): void
    {
        $this->loadUsers($manager);
    }

    private function loadUsers(ObjectManager $manager): void
    {
        foreach ($this->getUserData() as [$username, $email, $password, $roles]) {
            $user = new User();
            $user->setUsername($username);
            $user->setEmail($email);
            $user->setPassword($this->encoder->encodePassword($user, $password));
            $user->setRoles($roles);


            $manager->persist($user);

        }

        $manager->flush();
    }

    private function getUserData(): array
    {
        return [
            ['user', 'user@test.com', 'user', ['ROLE_USER']],
            ['user2', 'user2@test.com', 'use2r', ['ROLE_USER']],
            ['admin', 'admin@test.com', 'admin', ['ROLE_ADMIN']],
        ];
    }
}