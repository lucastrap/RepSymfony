<?php

namespace App\Entity;
use Cocur\Slugify\Slugify;
use EsperoSoft\DateFormat\DateFormat;
use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeRepository::class)]
class Type
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'type', targetEntity: Artiste::class)]
    private Collection $artiste;

    public function __construct()
    {
        $this->artiste = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Artiste>
     */
    public function getArtiste(): Collection
    {
        return $this->artiste;
    }

    public function addArtiste(Artiste $artiste): self
    {
        if (!$this->artiste->contains($artiste)) {
            $this->artiste->add($artiste);
            $artiste->setType($this);
        }

        return $this;
    }

    public function removeArtiste(Artiste $artiste): self
    {
        if ($this->artiste->removeElement($artiste)) {
            // set the owning side to null (unless already changed)
            if ($artiste->getType() === $this) {
                $artiste->setType(null);
            }
        }

        return $this;
    }
    public function updateSlug(): void {
        $slugify = new Slugify();
        $this->slug = $slugify->slugify($this->type);
    }
}
