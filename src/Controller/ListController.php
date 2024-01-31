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
        // Récupérer l'utilisateur actuel
        $user = $this->getUser();

        if ($user instanceof UserInterface) {
            // Récupérer l'ID de l'utilisateur
            $userId = $user->getId();

            // Récupérer toutes les Todolists de l'utilisateur actuel avec leurs ID
            $todolists = $this->entityManager
                ->getRepository(Todolist::class)
                ->findBy(['user' => $userId]);

            // Récupérer toutes les tâches associées à chaque todolist
            $tasks = [];
            foreach ($todolists as $todolist) {
                $tasks[$todolist->getId()] = $this->entityManager
                    ->getRepository(Task::class)
                    ->findBy(['todolist' => $todolist->getId()]);
            }

            // Créer un nouveau formulaire de tâche
            $task = new Task();
            $form = $this->createForm(NewTaskType::class, $task);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $task = $form->getData();
                $this->entityManager->persist($task);
                $this->entityManager->flush();

                // Redirigez l'utilisateur vers la même page après avoir ajouté la tâche
                return $this->redirectToRoute('app_list');
            }

            // Passer les Todolists, les tâches et le formulaire de création de tâches à la vue
            return $this->render('list/index.html.twig', [
                'todolists' => $todolists,
                'tasks' => $tasks,
                'form' => $form->createView(),
            ]);
        } else {
            // Gérer le cas où aucun utilisateur n'est connecté
            // Redirection vers la page de connexion, affichage d'un message d'erreur, etc.
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


