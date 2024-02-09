<?php

namespace App\Repository;

use App\Entity\ImageToDoList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ImageToDoList>
 *
 * @method ImageToDoList|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImageToDoList|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImageToDoList[]    findAll()
 * @method ImageToDoList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageToDoListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImageToDoList::class);
    }

//    /**
//     * @return ImageToDoList[] Returns an array of ImageToDoList objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ImageToDoList
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
