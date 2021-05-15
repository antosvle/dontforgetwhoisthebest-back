<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PlayersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlayersRepository::class)
 */
#[ApiResource]
class Players
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="date")
     */
    private $creation_date;

    /**
     * @ORM\OneToMany(targetEntity=Selections::class, mappedBy="player")
     */
    private $selections;

    public function __construct()
    {
        $this->selections = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    /**
     * @return Collection|Selections[]
     */
    public function getSelections(): Collection
    {
        return $this->selections;
    }

    public function addSelection(Selections $selection): self
    {
        if (!$this->selections->contains($selection)) {
            $this->selections[] = $selection;
            $selection->setPlayer($this);
        }

        return $this;
    }

    public function removeSelection(Selections $selection): self
    {
        if ($this->selections->removeElement($selection)) {
            // set the owning side to null (unless already changed)
            if ($selection->getPlayer() === $this) {
                $selection->setPlayer(null);
            }
        }

        return $this;
    }
}
