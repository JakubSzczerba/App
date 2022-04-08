<?php

namespace App\Repository;

use App\Entity\Proposal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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
            ->leftJoin('p.user', 'u')
            ->where('u.id = :user')
            ->setParameter('user', $id);

        return $qb->getQuery()->getArrayResult();
    }
}