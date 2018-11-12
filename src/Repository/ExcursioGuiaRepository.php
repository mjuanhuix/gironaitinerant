<?php

namespace App\Repository;

use App\Entity\ExcursioGuia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ExcursioGuia|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExcursioGuia|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExcursioGuia[]    findAll()
 * @method ExcursioGuia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExcursioGuiaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ExcursioGuia::class);
    }

//    /**
//     * @return Excursio[] Returns an array of ExcursioGuia objects
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
    public function findOneBySomeField($value): ?Excursio
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
