<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\CiutatRepository")
 */

class Ciutat
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
     * @ORM\Column(type="integer")
     */
    private $cp;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Escola", mappedBy="relation")
     */
    private $escolas;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ruta", mappedBy="ciutat")
     */
    private $rutas;

    public function __construct()
    {
        $this->escolas = new ArrayCollection();
        $this->rutas = new ArrayCollection();
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

    public function getCp(): ?int
    {
        return $this->cp;
    }

    public function setCp(int $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * @return Collection|Escola[]
     */
    public function getEscolas(): Collection
    {
        return $this->escolas;
    }

    public function addEscola(Escola $escola): self
    {
        if (!$this->escolas->contains($escola)) {
            $this->escolas[] = $escola;
            $escola->setRelation($this);
        }

        return $this;
    }

    public function removeEscola(Escola $escola): self
    {
        if ($this->escolas->contains($escola)) {
            $this->escolas->removeElement($escola);
            // set the owning side to null (unless already changed)
            if ($escola->getCiutat() === $this) {
                $escola->setCiutat(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Ruta[]
     */
    public function getRutas(): Collection
    {
        return $this->rutas;
    }

    public function addRuta(Ruta $ruta): self
    {
        if (!$this->rutas->contains($ruta)) {
            $this->rutas[] = $ruta;
            $ruta->setCiutat($this);
        }

        return $this;
    }

    public function removeRuta(Ruta $ruta): self
    {
        if ($this->rutas->contains($ruta)) {
            $this->rutas->removeElement($ruta);
            // set the owning side to null (unless already changed)
            if ($ruta->getCiutat() === $this) {
                $ruta->setCiutat(null);
            }
        }

        return $this;
    }


    public function __toString() {
        return $this->nom;
    }
}
