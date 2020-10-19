<?php

namespace App\Repository;

use App\Entity\ArticlesNotes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;

/**
 * @method ArticlesNotes|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticlesNotes|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticlesNotes[]    findAll()
 * @method ArticlesNotes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticlesNotesRepository extends ServiceEntityRepository
{
    public function __construct(PersistenceManagerRegistry $registry)
    {
        parent::__construct($registry, ArticlesNotes::class);
    }

    // /**
    //  * @return ArticlesNotes[] Returns an array of Articles objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Articles
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}