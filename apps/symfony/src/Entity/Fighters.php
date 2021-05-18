<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\FightersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=FightersRepository::class)
 */
#[ApiResource]
class Fighters
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"score"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"score"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"score"})
     */
    private $img;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"score"})
     */
    private $icon;

    /**
     * @ORM\OneToMany(targetEntity=Selections::class, mappedBy="fighter")
     */
    private $selections;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"score"})
     */
    private $page;

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

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg($img): self
    {
        $this->img = $img;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon($icon): self
    {
        $this->icon = $icon;

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
            $selection->setFighter($this);
        }

        return $this;
    }

    public function removeSelection(Selections $selection): self
    {
        if ($this->selections->removeElement($selection)) {
            // set the owning side to null (unless already changed)
            if ($selection->getFighter() === $this) {
                $selection->setFighter(null);
            }
        }

        return $this;
    }

    public function getPage(): ?string
    {
        return $this->page;
    }

    public function setPage(?string $page): self
    {
        $this->page = $page;

        return $this;
    }
}
