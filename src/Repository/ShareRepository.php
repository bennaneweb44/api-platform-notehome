<?php

namespace App\Repository;

use App\Entity\Note;
use App\Entity\Share;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Share>
 *
 * @method Share|null find($id, $lockMode = null, $lockVersion = null)
 * @method Share|null findOneBy(array $criteria, array $orderBy = null)
 * @method Share[]    findAll()
 * @method Share[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShareRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Share::class);
    }

    public function add(Share $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Share $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findNotSeenUpdates(User $user, ?Note $note): array
    {
        $result = $this->createQueryBuilder('s')
            ->where('(s.user_1 = :user OR s.user_2 = :user) AND s.updated_by != :user')
            ->setParameter('user', $user->getId());

            if ($note) {
                $result = $result->andWhere('s.note = :note')
                        ->setParameter('note', $note->getId());
            }

            $result = $result->andWhere('s.seen = 0')
                    ->getQuery()
                    ->getResult();
            
        return $result;    
    }

//    /**
//     * @return Share[] Returns an array of Share objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Share
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
