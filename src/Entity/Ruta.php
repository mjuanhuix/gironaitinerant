<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;



/**
 * @ORM\Entity(repositoryClass="App\Repository\RutaRepository")
 */
class Ruta
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ciutat", inversedBy="rutas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ciutat;

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

    public function getCiutat(): ?Ciutat
    {
        return $this->ciutat;
    }

    public function setCiutat(?Ciutat $ciutat): self
    {
        $this->ciutat = $ciutat;

        return $this;
    }

    public function __toString() {
        return $this->nom;
    }
}
