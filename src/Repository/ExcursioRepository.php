<?php

namespace App\Repository;

use App\Entity\Excursio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Excursio|null find($id, $lockMode = null, $lockVersion = null)
 * @method Excursio|null findOneBy(array $criteria, array $orderBy = null)
 * @method Excursio[]    findAll()
 * @method Excursio[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExcursioRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Excursio::class);
    }


    public function futur($valor){


        return $this->createQueryBuilder('p')
            ->andWhere('p.data > :avui')
            ->setParameter('avui', $valor)
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;

    }

//    /**
//     * @return Excursio[] Returns an array of Excursio objects
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
