<?php

namespace App\Repository;

use App\Entity\Review;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Review|null find($id, $lockMode = null, $lockVersion = null)
 * @method Review|null findOneBy(array $criteria, array $orderBy = null)
 * @method Review[]    findAll()
 * @method Review[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReviewRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Review::class);
    }

    // /**
    //  * @return Review[] Returns an array of Review objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Review
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


    public function findAverageBookRating($bookId, \DateTime $dateFrom, \DateTime $dateTo)
    {
        return $this->createQueryBuilder('r')
            ->select('AVG(r.rating) AS average_rating')
            ->join('r.book', 'b')
            ->andWhere('r.createdAt >= :dateFrom')
            ->andWhere('r.createdAt <= :dateTo')
            ->andWhere('b.id = :bookId')
            ->setParameter('bookId', $bookId)
            ->setParameter('dateFrom', $dateFrom)
            ->setParameter('dateTo', $dateTo)
            ->groupBy('r.book')
            ->getQuery()
            ->getSingleScalarResult();


    }

    public function findBookRatingByUser($userId, \DateTime $dateFrom, \DateTime $dateTo)
    {
        return $this->createQueryBuilder('r')
            ->select(['b.id', 'b.title', 'r.rating'])
            ->join('r.book', 'b')
            ->join('r.user', 'u')
            ->andWhere('r.createdAt >= :dateFrom')
            ->andWhere('r.createdAt <= :dateTo')
            ->andWhere('u.id = :userId')
            ->setParameter('userId', $userId)
            ->setParameter('dateFrom', $dateFrom)
            ->setParameter('dateTo', $dateTo)
            ->groupBy('r.user')
            ->getQuery()
            ->getArrayResult();

    }
}
