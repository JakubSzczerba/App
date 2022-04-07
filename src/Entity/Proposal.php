<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="proposal")
 */

class Proposal
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    private $name;
    /**
     * @ORM\Column(type="string")
     */
    private $activity;
    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date")
     */
    private $datetime;
    /**
     * @Assert\Image(
     *     allowLandscape = false,
     *     allowPortrait = false
     * )
     */
    private $cover;
    /**
     * @ORM\Column(type="string")
     */
    private $description;
    /**
     * @ORM\Column(type="integer")
     */
    private $value;

    public function __construct()
    {
        $this->datetime = new \DateTime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getActivity(): ?string
    {
        return $this->activity;
    }

    public function setActivity($activity): void
    {
        $this->activity = $activity;
    }

    public function getDatetime(): \DateTime
    {
        return $this->datetime;
    }

    public function setDatetime(\DateTime $datetime): void
    {
        $this->datetime = $datetime;
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover($cover): void
    {
        $this->cover = $cover;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue($value): void
    {
        $this->value = $value;
    }
}