<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\EscolaRepository")
 */
class Escola
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $adreca;

    /**
     * @ORM\Column(type="string", length=11, nullable=true)
     */
    private $NIF;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ciutat", inversedBy="escolas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ciutat;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Professor", mappedBy="escola")
     */
    private $professors;

    public function __construct()
    {
        $this->professors = new ArrayCollection();
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

    public function getAdreca(): ?string
    {
        return $this->adreca;
    }

    public function setAdreca(?string $adreca): self
    {
        $this->adreca = $adreca;

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

    public function getCiutat(): ?Ciutat
    {
        return $this->ciutat;
    }

    public function setCiutat(?Ciutat $ciutat): self
    {
        $this->relation = $ciutat;

        return $this;
    }

    /**
     * @return Collection|Professor[]
     */
    public function getProfessors(): Collection
    {
        return $this->professors;
    }

    public function addProfessor(Professor $professor): self
    {
        if (!$this->professors->contains($professor)) {
            $this->professors[] = $professor;
            $professor->setEscola($this);
        }

        return $this;
    }

    public function removeProfessor(Professor $professor): self
    {
        if ($this->professors->contains($professor)) {
            $this->professors->removeElement($professor);
            // set the owning side to null (unless already changed)
            if ($professor->getEscola() === $this) {
                $professor->setEscola(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return $this->nom;
    }
}
