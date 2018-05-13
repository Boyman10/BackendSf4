<?php

namespace App\Domain\Repository;

use App\Domain\Entity\TicketPerson;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TicketPerson|null find($id, $lockMode = null, $lockVersion = null)
 * @method TicketPerson|null findOneBy(array $criteria, array $orderBy = null)
 * @method TicketPerson[]    findAll()
 * @method TicketPerson[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TicketPersonRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TicketPerson::class);
    }

//    /**
//     * @return TicketPerson[] Returns an array of TicketPerson objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TicketPerson
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
