<?php

namespace App\Repository;

use App\Entity\ProposalFilled;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class FilledProposalsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProposalFilled::class);
    }

    /**
     * @return userFilledProposals[]
     */
    public function userFilledProposals(int $id)
    {
        $qb = $this->createQueryBuilder('p');

        $qb->select('p', 'u', 'f')
            ->leftJoin('p.users', 'u')
            ->join('p.proposal', 'f')
            ->where('u.id = :user')
            ->setParameter('user', $id);

        //dd($qb->getQuery()->getArrayResult());
        return $qb->getQuery()->getArrayResult();
    }

}