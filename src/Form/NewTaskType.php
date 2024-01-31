<?php

// src/Form/NewTaskType.php

namespace App\Form;

use App\Entity\Task;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Todolist;
use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\EntityRepository;


class NewTaskType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user = $this->security->getUser();

        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de la tâche',
                'attr' => ['placeholder' => 'Entrez le nom de la tâche']
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description de la tâche',
                'attr' => ['placeholder' => 'Entrez la description de la tâche']
            ])
            ->add('todolist', EntityType::class, [
                'class' => Todolist::class,
                'choice_label' => 'title',
                'query_builder' => function (EntityRepository $er) use ($user) {
                    return $er->createQueryBuilder('t')
                        ->andWhere('t.user = :user')
                        ->setParameter('user', $user);
                },
                'attr' => ['placeholder' => 'Créer avant une nouvelle To Do List']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
