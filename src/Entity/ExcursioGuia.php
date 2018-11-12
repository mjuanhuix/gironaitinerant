<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExcursioGuiaRepository")
 */
class ExcursioGuia
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Guia", inversedBy="excursioGuias")
     * @ORM\JoinColumn(nullable=false)
     */
    private $guia;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Excursio", inversedBy="excursioGuias")
     * @ORM\JoinColumn(nullable=false)
     */
    private $excursio;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $import;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGuia(): ?Guia
    {
        return $this->guia;
    }

    public function setGuia(?Guia $guia): self
    {
        $this->guia = $guia;

        return $this;
    }

    public function getExcursio(): ?Excursio
    {
        return $this->excursio;
    }

    public function setExcursio(?Excursio $excursio): self
    {
        $this->excursio = $excursio;

        return $this;
    }

    public function getImport(): ?float
    {
        return $this->import;
    }

    public function setImport(?float $import): self
    {
        $this->import = $import;

        return $this;
    }
}
