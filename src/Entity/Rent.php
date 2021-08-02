<?php

namespace App\Entity;

use App\Repository\RentRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RentRepository::class)
 */
class Rent
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="rents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idClient;

    /**
     * @ORM\ManyToMany(targetEntity=Movie::class, inversedBy="rents")
     */
    private $idMovie;

    /**
     * @ORM\Column(type="date")
     */
    private $dateRent;

    /**
     * @ORM\Column(type="integer")
     */
    private $lengthRent;

    /**
     * @ORM\Column(type="date")
     */
    private $returnDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $actualReturnDate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isDelayed;

    /**
     * @ORM\Column(type="float")
     */
    private $priceRent;

    /**
     * @ORM\Column(type="float")
     */
    private $delayPrice;

    public function __construct()
    {
        $this->idMovie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdClient(): ?Client
    {
        return $this->idClient;
    }

    public function setIdClient(?Client $idClient): self
    {
        $this->idClient = $idClient;

        return $this;
    }

    /**
     * @return Collection|Movie[]
     */
    public function getIdMovie(): Collection
    {
        return $this->idMovie;
    }

    public function addIdMovie(Movie $idMovie): self
    {
        if (!$this->idMovie->contains($idMovie)) {
            $this->idMovie[] = $idMovie;
        }

        return $this;
    }

    public function removeIdMovie(Movie $idMovie): self
    {
        $this->idMovie->removeElement($idMovie);

        return $this;
    }

    public function getDateRent(): ?DateTimeInterface
    {
        return $this->dateRent;
    }

    public function setDateRent(DateTimeInterface $dateRent): self
    {
        $this->dateRent = $dateRent;

        return $this;
    }

    public function getLengthRent(): ?int
    {
        return $this->lengthRent;
    }

    public function setLengthRent(int $lengthRent): self
    {
        $this->lengthRent = $lengthRent;

        return $this;
    }

    public function getReturnDate(): ?DateTimeInterface
    {
        return $this->returnDate;
    }

    public function setReturnDate(DateTimeInterface $returnDate): self
    {
        $this->returnDate = $returnDate;

        return $this;
    }

    public function getActualReturnDate(): ?DateTimeInterface
    {
        return $this->actualReturnDate;
    }

    public function setActualReturnDate(?DateTimeInterface $actualReturnDate): self
    {
        $this->actualReturnDate = $actualReturnDate;

        return $this;
    }

    public function getIsDelayed(): ?bool
    {
        return $this->isDelayed;
    }

    public function setIsDelayed(bool $isDelayed): self
    {
        $this->isDelayed = $isDelayed;

        return $this;
    }

    public function getPriceRent(): ?float
    {
        return $this->priceRent;
    }

    public function setPriceRent(float $priceRent): self
    {
        $this->priceRent = $priceRent;

        return $this;
    }

    public function getDelayPrice(): ?float
    {
        return $this->delayPrice;
    }

    public function setDelayPrice(float $delayPrice): self
    {
        $this->delayPrice = $delayPrice;

        return $this;
    }
}
