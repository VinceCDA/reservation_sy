<?php

namespace App\Entity;

use App\Repository\TrajetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrajetRepository::class)]
class Trajet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $gareDepart = null;

    #[ORM\Column(length: 255)]
    private ?string $gareArrivee = null;

    #[ORM\Column]
    private ?\DateTime $departLe = null;

    #[ORM\Column]
    private ?\DateTime $arriveeLe = null;

    #[ORM\Column]
    private ?int $prix = null;

    #[ORM\Column(nullable: true)]
    private ?int $placeTotales = null;

    /**
     * @var Collection<int, Reservation>
     */
    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'trajet', orphanRemoval: true)]
    private Collection $reservations;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGareDepart(): ?string
    {
        return $this->gareDepart;
    }

    public function setGareDepart(string $gareDepart): static
    {
        $this->gareDepart = $gareDepart;

        return $this;
    }

    public function getGareArrivee(): ?string
    {
        return $this->gareArrivee;
    }

    public function setGareArrivee(string $gareArrivee): static
    {
        $this->gareArrivee = $gareArrivee;

        return $this;
    }

    public function getDepartLe(): ?\DateTime
    {
        return $this->departLe;
    }

    public function setDepartLe(\DateTime $departLe): static
    {
        $this->departLe = $departLe;

        return $this;
    }

    public function getArriveeLe(): ?\DateTime
    {
        return $this->arriveeLe;
    }

    public function setArriveeLe(\DateTime $arriveeLe): static
    {
        $this->arriveeLe = $arriveeLe;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getPlaceTotales(): ?int
    {
        return $this->placeTotales;
    }

    public function setPlaceTotales(?int $placeTotales): static
    {
        $this->placeTotales = $placeTotales;

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setTrajet($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getTrajet() === $this) {
                $reservation->setTrajet(null);
            }
        }

        return $this;
    }
}
