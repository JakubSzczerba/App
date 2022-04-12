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

        $qb->select('p')
            ->leftJoin('p.users', 'u')
            ->where('u.id = :user')
            ->setParameter('user', $id);

        return $qb->getQuery()->getArrayResult();
    }

}