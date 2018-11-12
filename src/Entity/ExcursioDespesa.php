<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

class ExcursioDespesa
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
     * @ORM\Column(type="float")
     */
    private $import;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $factura;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Excursio", inversedBy="excursioDespesas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $excursio;

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

    public function getImport(): ?float
    {
        return $this->import;
    }

    public function setImport(float $import): self
    {
        $this->import = $import;

        return $this;
    }

    public function getFactura(): ?string
    {
        return $this->factura;
    }

    public function setFactura(?string $factura): self
    {
        $this->factura = $factura;

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
}
