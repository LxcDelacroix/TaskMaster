<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Todolist;
use App\Entity\Task;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user1 = new User();
        $user1->setUsername('john_doe');
        $user1->setMail('john_doe@example.com');
        $user1->setRoles(['ROLE_ADMIN']);
        $user1->setPassword(
            $this->passwordHasher->hashPassword(
                $user1,
                'admin57'
            )
        );

        $manager->persist($user1);

        $user2 = new User();
        $user2->setUsername('jane_doe');
        $user2->setMail('jane_doe@example.com');
        $user2->setPassword(
            $this->passwordHasher->hashPassword(
                $user2,
                'jane_doe57'
            )
        );

        $manager->persist($user2);

        $todolist1 = new Todolist();
        $todolist1->setTitle('WinnterZuko');
        $todolist1->setUser($user1);
        $manager->persist($todolist1);

        $todolist2 = new Todolist();
        $todolist2->setTitle('Projet Symfony');
        $todolist2->setUser($user2);
        $manager->persist($todolist2);

        $task1 = new Task();
        $task1->setName('Ecouter WinnterZuko');
        $task1->setDescription('Savourer ce miel pour les oreilles.');
        $task1->setTodolist($todolist1);
        $manager->persist($task1);

        $task2 = new Task();
        $task2->setName('Réunion client');
        $task2->setDescription('Préparer la réunion client de demain.');
        $task2->setTodolist($todolist2);
        $manager->persist($task2);

        $manager->flush();
    }
}

