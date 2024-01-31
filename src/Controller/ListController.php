<?php

namespace App\Controller;

use App\Entity\Todolist;
use App\Entity\Task;
use App\Form\NewTaskType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class ListController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('{_locale}/list', name: 'app_list')]
    public function index(Request $request): Response
    {
        $user = $this->getUser();

        if ($user instanceof UserInterface) {
            $userId = $user->getId();

            $todolists = $this->entityManager
                ->getRepository(Todolist::class)
                ->findBy(['user' => $userId]);

            $tasks = [];
            foreach ($todolists as $todolist) {
                $tasks[$todolist->getId()] = $this->entityManager
                    ->getRepository(Task::class)
                    ->findBy(['todolist' => $todolist->getId()]);
            }

            $task = new Task();
            $form = $this->createForm(NewTaskType::class, $task);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $task = $form->getData();
                $this->entityManager->persist($task);
                $this->entityManager->flush();

                return $this->redirectToRoute('app_list');
            }

            return $this->render('list/index.html.twig', [
                'todolists' => $todolists,
                'tasks' => $tasks,
                'form' => $form->createView(),
            ]);
        } else {
            return $this->redirectToRoute('app_login');
        }
    }

    #[Route('{_locale}/delete-task/{id}', name: 'app_delete_task')]
    public function deleteTask(int $id, EntityManagerInterface $entityManager): Response
    {
        $task = $entityManager->getRepository(Task::class)->find($id);
        $entityManager->remove($task);
        $entityManager->flush();


        return $this->redirectToRoute('app_list');
    }

    #[Route('{_locale}/edit-task/{id}', name: 'app_edit_task')]
    public function editTask(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $task = $entityManager->getRepository(Task::class)->find($id);

        $form = $this->createForm(NewTaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('app_list');
        }

        return $this->render('list/edit_task.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}


