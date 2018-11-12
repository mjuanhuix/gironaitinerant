<?php

namespace App\Repository;

use App\Entity\Curs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Curs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Curs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Curs[]    findAll()
 * @method Curs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CursRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Curs::class);
    }

//    /**
//     * @return Curs[] Returns an array of Curs objects
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
    public function findOneBySomeField($value): ?Curs
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
