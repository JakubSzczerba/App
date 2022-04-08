<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity()
 * @ORM\Table(name="proposal_filled")
 */

class ProposalFilled
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(type="integer")
     */
    private $value;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Proposal", inversedBy="proposalFilled")
     * @ORM\JoinColumn(name="proposal_id", nullable=false, referencedColumnName="id")
     */
    private $proposal;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="filledByUser")
     * @ORM\JoinColumn(name="users_id", nullable=false, referencedColumnName="id")
     */
    private $users;

    public function getId()
    {
        return $this->id;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue($value): void
    {
        $this->value = $value;
    }

    public function getProposal(): ?Proposal
    {
        return $this->proposal;
    }

    public function setProposal($proposal): void
    {
        $this->proposal = $proposal;
    }

    public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(?User $users): self
    {
        $this->users = $users;
        return $this;
    }

}