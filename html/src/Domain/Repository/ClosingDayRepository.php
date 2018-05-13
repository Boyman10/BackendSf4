<?php

namespace App\Domain\Repository;

use App\Domain\Entity\ClosingDay;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ClosingDay|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClosingDay|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClosingDay[]    findAll()
 * @method ClosingDay[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClosingDayRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ClosingDay::class);
    }

//    /**
//     * @return ClosingDay[] Returns an array of ClosingDay objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ClosingDay
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
