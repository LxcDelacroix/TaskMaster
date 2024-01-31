<?php

namespace App\Controller;

use App\Entity\Todolist;
use App\Form\NewListType;
use App\Form\NewTaskType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewListController extends AbstractController
{
    #[Route('{_locale}/new/list', name: 'app_new_list')]
    public function newList(Request $request, EntityManagerInterface $entityManager): Response
    {
        $todolist = new Todolist();
        $form = $this->createForm(NewListType::class, $todolist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $todolist->setUser($this->getUser());
            $entityManager->persist($todolist);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('new_list/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
