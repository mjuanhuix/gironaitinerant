<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;



/**
 * @ORM\Entity(repositoryClass="App\Repository\ExcursioRepository")
 */
class Excursio
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $data;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $numero_alumnes;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $horaris;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $import;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $factura_signada;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $data_pagament;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Curs")
     */
    private $curs;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ruta")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ruta;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Escola")
     * @ORM\JoinColumn(nullable=false)
     */
    private $escola;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ExcursioDespesa", mappedBy="excursio", orphanRemoval=true)
     */
    private $excursioDespesas;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Professor", mappedBy="excursio")
     */
    private $professors;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ExcursioGuia", mappedBy="excursio", orphanRemoval=true)
     */
    private $excursioGuias;

    public function __construct()
    {
        $this->excursioDespesas = new ArrayCollection();
        $this->professors = new ArrayCollection();
        $this->excursioGuias = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getData(): ?\DateTimeInterface
    {
        return $this->data;
    }

    public function setData(\DateTimeInterface $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function getNumeroAlumnes(): ?int
    {
        return $this->numero_alumnes;
    }

    public function setNumeroAlumnes(?int $numero_alumnes): self
    {
        $this->numero_alumnes = $numero_alumnes;

        return $this;
    }

    public function getHoraris(): ?string
    {
        return $this->horaris;
    }

    public function setHoraris(?string $horaris): self
    {
        $this->horaris = $horaris;

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

    public function getFacturaSignada(): ?bool
    {
        return $this->factura_signada;
    }

    public function setFacturaSignada(?bool $factura_signada): self
    {
        $this->factura_signada = $factura_signada;

        return $this;
    }

    public function getDataPagament(): ?\DateTimeInterface
    {
        return $this->data_pagament;
    }

    public function setDataPagament(?\DateTimeInterface $data_pagament): self
    {
        $this->data_pagament = $data_pagament;

        return $this;
    }

    public function getCurs(): ?Curs
    {
        return $this->curs;
    }

    public function setCurs(?Curs $curs): self
    {
        $this->curs = $curs;

        return $this;
    }

    public function getRuta(): ?Ruta
    {
        return $this->ruta;
    }

    public function setRuta(?Ruta $ruta): self
    {
        $this->ruta = $ruta;

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
     * @return Collection|ExcursioDespesa[]
     */

    public function getExcursioDespesas(): Collection
    {
        return $this->excursioDespesas;
    }

    public function addExcursioDespesa(ExcursioDespesa $excursioDespesa): self
    {
        if (!$this->excursioDespesas->contains($excursioDespesa)) {
            $this->excursioDespesas[] = $excursioDespesa;
            $excursioDespesa->setExcursio($this);
        }

        return $this;
    }

    public function removeExcursioDespesa(ExcursioDespesa $excursioDespesa): self
    {
        if ($this->excursioDespesas->contains($excursioDespesa)) {
            $this->excursioDespesas->removeElement($excursioDespesa);
            // set the owning side to null (unless already changed)
            if ($excursioDespesa->getExcursio() === $this) {
                $excursioDespesa->setExcursio(null);
            }
        }

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
            $professor->addExcursio($this);
        }

        return $this;
    }

    public function removeProfessor(Professor $professor): self
    {
        if ($this->professors->contains($professor)) {
            $this->professors->removeElement($professor);
            $professor->removeExcursio($this);
        }

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
            $excursioGuia->setExcursio($this);
        }

        return $this;
    }

    public function removeExcursioGuia(ExcursioGuia $excursioGuia): self
    {
        if ($this->excursioGuias->contains($excursioGuia)) {
            $this->excursioGuias->removeElement($excursioGuia);
            // set the owning side to null (unless already changed)
            if ($excursioGuia->getExcursio() === $this) {
                $excursioGuia->setExcursio(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return $this->data;
    }
}
