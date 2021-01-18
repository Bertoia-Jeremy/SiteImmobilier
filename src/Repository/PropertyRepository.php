<?php

namespace App\Repository;

use Doctrine\ORM\Query;
use App\Entity\Property;
use App\Entity\PropertySearch;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Property::class);
    }

    /**
     * @return Query
     */

    public function findAllVisibleQuery(PropertySearch $search): Query
    {
        $query = $this->createQueryBuilder('p')
                      ->Where('p.sold = false');

        if($search->getMaxPrice()){
            $query = $query->andWhere('p.price < :maxprice')
                            ->setParameter('maxprice', $search->getMaxPrice());
        }
                      
        if($search->getMinSurface()){
            $query = $query->andWhere('p.surface > :minsurface')
                            ->setParameter('minsurface', $search->getMinSurface());
        }

        if($search->getOptions()->count() > 0){
            $k = 0;
            foreach($search->getOptions() as $option){
                $query = $query->andWhere(":option$k MEMBER OF p.options")
                               ->setParameter("option$k", $option);
                $k++;
            }
        }

        return $query->getQuery();
    }

    /**
     * @return Property[] Returns an array of Property objects
     */
    public function findLatest(): array
    {
        return $this->findVisibleQuery()
                    ->getQuery()
                    ->getResult();
    }

    /**
     * @return Property[] Returns an array of Property objects
     */
    public function findByOption($option): array
    {
        return $this->findVisibleQuery()
                    ->andWhere(":option MEMBER OF p.options ")
                        ->setParameter("option", $option->getId())
                    ->getQuery()
                    ->getResult();
    }

    private function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('p')
                    ->setMaxResults(4)
                    ->Where('p.sold = false');
    }

    /*
    public function findOneBySomeField($value): ?Property
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
