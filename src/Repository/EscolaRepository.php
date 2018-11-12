<?php

namespace App\Repository;

use App\Entity\Escola;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Escola|null find($id, $lockMode = null, $lockVersion = null)
 * @method Escola|null findOneBy(array $criteria, array $orderBy = null)
 * @method Escola[]    findAll()
 * @method Escola[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EscolaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Escola::class);
    }

//    /**
//     * @return Escola[] Returns an array of Escola objects
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
    public function findOneBySomeField($value): ?Escola
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
