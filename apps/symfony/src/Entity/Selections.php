<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SelectionsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SelectionsRepository::class)
 */
#[ApiResource]
class Selections
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Players::class, inversedBy="selections")
     * @ORM\JoinColumn(nullable=false)
     */
    private $player;

    /**
     * @ORM\ManyToOne(targetEntity=Fighters::class, inversedBy="selections")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fighter;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayer(): ?Players
    {
        return $this->player;
    }

    public function setPlayer(?Players $player): self
    {
        $this->player = $player;

        return $this;
    }

    public function getFighter(): ?Fighters
    {
        return $this->fighter;
    }

    public function setFighter(?Fighters $fighter): self
    {
        $this->fighter = $fighter;

        return $this;
    }
}
