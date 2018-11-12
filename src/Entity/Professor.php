<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ProfessorRepository")
 */
class Professor
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $mail;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $telefon;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Escola", inversedBy="professors")
     * @ORM\JoinColumn(nullable=false)
     */
    private $escola;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Excursio", inversedBy="professors")
     */
    private $excursio;

    public function __construct()
    {
        $this->excursio = new ArrayCollection();
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

    public function getEscola(): ?Escola
    {
        return $this->escola;
    }

    public function setEscola(?Escola $escola): self
    {
        $this->escola = $escola;

        return $this;
    }

    /**
     * @return Collection|Excursio[]
     */
    public function getExcursio(): Collection
    {
        return $this->excursio;
    }

    public function addExcursio(Excursio $excursio): self
    {
        if (!$this->excursio->contains($excursio)) {
            $this->excursio[] = $excursio;
        }

        return $this;
    }

    public function removeExcursio(Excursio $excursio): self
    {
        if ($this->excursio->contains($excursio)) {
            $this->excursio->removeElement($excursio);
        }

        return $this;
    }
}
