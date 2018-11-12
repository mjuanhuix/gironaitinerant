<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\GuiaRepository")
 */
class Guia
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $NIF;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $mail;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $telefon;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $adreca;

    /**
     * @ORM\Column(type="string", length=24, nullable=true)
     */
    private $IBAN;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ciutat")
     */
    private $ciutat;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ExcursioGuia", mappedBy="guia", orphanRemoval=true)
     */
    private $excursioGuias;

    public function __construct()
    {
        $this->excursioGuias = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getNIF(): ?string
    {
        return $this->NIF;
    }

    public function setNIF(?string $NIF): self
    {
        $this->NIF = $NIF;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getTelefon(): ?int
    {
        return $this->telefon;
    }

    public function setTelefon(?int $telefon): self
    {
        $this->telefon = $telefon;

        return $this;
    }

    public function getAdreca(): ?string
    {
        return $this->adreca;
    }

    public function setAdreca(?string $adreca): self
    {
        $this->adreca = $adreca;

        return $this;
    }

    public function getIBAN(): ?string
    {
        return $this->IBAN;
    }

    public function setIBAN(?string $IBAN): self
    {
        $this->IBAN = $IBAN;

        return $this;
    }

    public function getCiutat(): ?Ciutat
    {
        return $this->ciutat;
    }

    public function setCiutat(?Ciutat $ciutat): self
    {
        $this->ciutat = $ciutat;

        return $this;
    }

    /**
     * @return Collection|ExcursioGuia[]
     */
    public function getExcursioGuias(): Collection
    {
        return $this->excursioGuias;
    }

    public function addExcursioGuia(ExcursioGuia $excursioGuia): self
    {
        if (!$this->excursioGuias->contains($excursioGuia)) {
            $this->excursioGuias[] = $excursioGuia;
            $excursioGuia->setGuia($this);
        }

        return $this;
    }

    public function removeExcursioGuia(ExcursioGuia $excursioGuia): self
    {
        if ($this->excursioGuias->contains($excursioGuia)) {
            $this->excursioGuias->removeElement($excursioGuia);
            // set the owning side to null (unless already changed)
            if ($excursioGuia->getGuia() === $this) {
                $excursioGuia->setGuia(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return $this->nom;
    }
}
