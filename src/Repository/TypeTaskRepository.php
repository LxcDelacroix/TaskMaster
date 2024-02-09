<?php

namespace App\Repository;

use App\Entity\TypeTask;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeTask>
 *
 * @method TypeTask|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeTask|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeTask[]    findAll()
 * @method TypeTask[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeTaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeTask::class);
    }

//    /**
//     * @return TypeTask[] Returns an array of TypeTask objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TypeTask
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
