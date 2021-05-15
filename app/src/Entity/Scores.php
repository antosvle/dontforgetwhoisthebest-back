<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ScoresRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ScoresRepository::class)
 */
#[ApiResource]
class Scores
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Selections::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $winner;

    /**
     * @ORM\ManyToOne(targetEntity=Selections::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $looser;

    /**
     * @ORM\ManyToOne(targetEntity=Stages::class, inversedBy="scores")
     */
    private $stage;

    /**
     * @ORM\Column(type="date")
     */
    private $creation_date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWinner(): ?Selections
    {
        return $this->winner;
    }

    public function setWinner(?Selections $winner): self
    {
        $this->winner = $winner;

        return $this;
    }

    public function getLooser(): ?Selections
    {
        return $this->looser;
    }

    public function setLooser(?Selections $looser): self
    {
        $this->looser = $looser;

        return $this;
    }

    public function getStage(): ?Stages
    {
        return $this->stage;
    }

    public function setStage(?Stages $stage): self
    {
        $this->stage = $stage;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creation_date;
    }

    public function setCreationDate(\DateTimeInterface $creation_date): self
    {
        $this->creation_date = $creation_date;

        return $this;
    }
}
