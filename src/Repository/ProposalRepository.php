<?php

namespace App\Repository;

use App\Entity\Proposal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr\Join;

class ProposalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Proposal::class);
    }

    /**
     * @return proposals[]
     */
    public function showProposals(int $id)
    {
        $qb = $this->createQueryBuilder('p');

        $qb->select('p')
            ->where('p.id = :user')
            ->setParameter('user', $id);

        return $qb->getQuery()->getArrayResult();
    }
}