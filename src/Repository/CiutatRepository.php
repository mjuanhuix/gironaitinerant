<?php

namespace App\Repository;

use App\Entity\Ciutat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Ciutat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ciutat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ciutat[]    findAll()
 * @method Ciutat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CiutatRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ciutat::class);
    }

//    /**
//     * @return Ciutat[] Returns an array of Ciutat objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ciutat
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
