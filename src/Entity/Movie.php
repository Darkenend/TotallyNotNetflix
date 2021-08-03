<?php /** @noinspection PhpPropertyOnlyWrittenInspection */

namespace App\Entity;

use App\Repository\MovieRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MovieRepository::class)
 */
class Movie
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
    private $originalTitle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titleDisplay;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isAdult;

    /**
     * @ORM\Column(type="string", length=2048, nullable=true)
     */
    private $plot;

    /**
     * @ORM\Column(type="date")
     */
    private $releaseDate;

    /**
     * @ORM\Column(type="integer")
     */
    private $runtimeMinutes;

    /**
     * @ORM\Column(type="integer")
     */
    private $stock;

    /**
     * @ORM\Column(type="integer")
     */
    private $offerType;

    /**
     * @ORM\ManyToMany(targetEntity=Rent::class, mappedBy="idMovie")
     */
    private $rents;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $idIMDB;

    public function __construct()
    {
        $this->rents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOriginalTitle(): ?string
    {
        return $this->originalTitle;
    }

    public function setOriginalTitle(string $originalTitle): self
    {
        $this->originalTitle = $originalTitle;

        return $this;
    }

    public function getTitleDisplay(): ?string
    {
        return $this->titleDisplay;
    }

    public function setTitleDisplay(?string $titleDisplay): self
    {
        $this->titleDisplay = $titleDisplay;

        return $this;
    }

    public function getIsAdult(): ?bool
    {
        return $this->isAdult;
    }

    public function setIsAdult(bool $isAdult): self
    {
        $this->isAdult = $isAdult;

        return $this;
    }

    public function getPlot(): ?string
    {
        return $this->plot;
    }

    public function setPlot(?string $plot): self
    {
        $this->plot = $plot;

        return $this;
    }

    public function getReleaseDate(): ?DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(DateTimeInterface $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getRuntimeMinutes(): ?int
    {
        return $this->runtimeMinutes;
    }

    public function setRuntimeMinutes(int $runtimeMinutes): self
    {
        $this->runtimeMinutes = $runtimeMinutes;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getOfferType(): ?int
    {
        return $this->offerType;
    }

    public function setOfferType(int $offerType): self
    {
        $this->offerType = $offerType;

        return $this;
    }

    /**
     * @return Collection|Rent[]
     */
    public function getRents(): Collection
    {
        return $this->rents;
    }

    public function addRent(Rent $rent): self
    {
        if (!$this->rents->contains($rent)) {
            $this->rents[] = $rent;
            $rent->addIdMovie($this);
        }

        return $this;
    }

    public function removeRent(Rent $rent): self
    {
        if ($this->rents->removeElement($rent)) {
            $rent->removeIdMovie($this);
        }

        return $this;
    }

    public function getIdIMDB(): ?string
    {
        return $this->idIMDB;
    }

    public function setIdIMDB(string $idIMDB): self
    {
        $this->idIMDB = $idIMDB;

        return $this;
    }

    public function __toString()
    {
        return $this->getTitleDisplay()." (".$this->getOriginalTitle().")";
    }
}
