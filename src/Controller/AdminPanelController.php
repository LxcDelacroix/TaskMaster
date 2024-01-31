<?php
// AdminPanelController.php

namespace App\Controller;

use App\Entity\Task;
use App\Entity\Todolist;
use App\Entity\User;
use App\Repository\TaskRepository;
use App\Repository\TodolistRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminPanelController extends AbstractController
{
    private $userRepository;
    private $todolistRepository;
    private $taskRepository;
    private $entityManager;

    public function __construct(UserRepository $userRepository, TodolistRepository $todolistRepository, TaskRepository $taskRepository, EntityManagerInterface $entityManager)
    {
        $this->userRepository = $userRepository;
        $this->todolistRepository = $todolistRepository;
        $this->taskRepository = $taskRepository;
        $this->entityManager = $entityManager;
    }

    #[Route('{_locale}/admin/panel', name: 'app_admin_panel')]
    public function index(): Response
    {
        $users = $this->userRepository->findAll();
        $todolists = $this->todolistRepository->findAll();
        $tasks = $this->taskRepository->findAll();

        return $this->render('admin_panel/index.html.twig', [
            'controller_name' => 'AdminPanelController',
            'users' => $users,
            'todolists' => $todolists,
            'tasks' => $tasks,
        ]);
    }

    #[Route('/delete-user/{id}', name: 'app_delete_user')]
    public function deleteUser(int $id, EntityManagerInterface $entityManager): Response
    {
        $user = $entityManager->getRepository(User::class)->find($id);
        $entityManager->remove($user);
        $entityManager->flush();
    
        return $this->redirectToRoute('app_admin_panel');
    }
 

    #[Route('/delete-todolist/{id}', name: 'app_delete_todolist')]
    public function deleteTodolist(int $id, EntityManagerInterface $entityManager): Response
    {
        $todolist = $entityManager->getRepository(Todolist::class)->find($id);

        if (!$todolist) {
            throw $this->createNotFoundException('Todolist not found');
        }

        $tasks = $todolist->getTasks();

        foreach ($tasks as $task) {
            $entityManager->remove($task);
        }

        $entityManager->remove($todolist);
        $entityManager->flush();

        return $this->redirectToRoute('app_admin_panel');
    }


    #[Route('/delete-task-admin/{id}', name: 'app_delete_task_admin')]
    public function deleteTask(int $id, EntityManagerInterface $entityManager): Response
    {
        $task = $entityManager->getRepository(Task::class)->find($id);
        $entityManager->remove($task);
        $entityManager->flush();

    
        return $this->redirectToRoute('app_admin_panel');
    }
}
