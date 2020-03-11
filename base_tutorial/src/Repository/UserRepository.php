<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\AbstractQuery;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findWithVideo($id): ?User
    {
        return $this->createQueryBuilder('u')
            ->innerJoin('u.videos', 'v')
            ->addSelect('v')
            ->andWhere('u.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }


    /**
     * @return User[] Returns an array of User objects
     */
    public function findWithVideoAndFollowed()
    {
        return $this->createQueryBuilder('u')
            ->innerJoin('u.videos', 'v')
            ->addSelect('v')
            ->innerJoin('u.followed', 'uf')
            ->addSelect('uf')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    
    public function findOneByName($name): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.Name = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    /**
     * @return User[]
     */
    public function getUserFromIdRangeExludeName($name, $start = 1, $end = 1){
        return $this->getEntityManager()
        ->createQuery(
            'SELECT u
            FROM App\Entity\User u
            WHERE u.id BETWEEN :start AND :end AND u.Name NOT LIKE :name
            ORDER BY u.id DESC'
        )->setParameters(['start'=>$start,'end'=>$end, 'name'=>$name])->getResult();
    }
}
