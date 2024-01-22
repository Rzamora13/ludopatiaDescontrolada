<?php

namespace App\Entity;

use App\Repository\SorteoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SorteoRepository::class)]
class Sorteo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fecha_inicio = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fecha_fin = null;

    #[ORM\Column]
    private ?int $precio_ticket = null;

    #[ORM\Column]
    private ?int $tickets_totales = null;

    #[ORM\Column(nullable: true)]
    private ?int $numero_ganador = null;

    #[ORM\OneToMany(mappedBy: 'sorteo', targetEntity: Apuesta::class)]
    private Collection $apuestas;

    #[ORM\Column(length: 255)]
    private ?string $premio = null;

    public function __construct()
    {
        
        $this->apuestas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->fecha_inicio;
    }

    public function setFechaInicio(\DateTimeInterface $fecha_inicio): static
    {
        $this->fecha_inicio = $fecha_inicio;

        return $this;
    }

    public function getFechaFin(): ?\DateTimeInterface
    {
        return $this->fecha_fin;
    }

    public function setFechaFin(\DateTimeInterface $fecha_fin): static
    {
        $this->fecha_fin = $fecha_fin;

        return $this;
    }

    public function getPrecioTicket(): ?int
    {
        return $this->precio_ticket;
    }

    public function setPrecioTicket(int $precio_ticket): static
    {
        $this->precio_ticket = $precio_ticket;

        return $this;
    }

    public function getTicketsTotales(): ?int
    {
        return $this->tickets_totales;
    }

    public function setTicketsTotales(int $tickets_totales): static
    {
        $this->tickets_totales = $tickets_totales;

        return $this;
    }

    public function getNumeroGanador(): ?int
    {
        return $this->numero_ganador;
    }

    public function setNumeroGanador(?int $numero_ganador): static
    {
        $this->numero_ganador = $numero_ganador;

        return $this;
    }

    public function generarNumeroGanador()
    {
        
        $numeroGanador = rand(1, $this->tickets_totales);

        $this->numero_ganador = $numeroGanador;
    }

    /**
     * @return Collection<int, Apuesta>
     */
    public function getApuestas(): Collection
    {
        return $this->apuestas;
    }

    public function addApuesta(Apuesta $apuesta): static
    {
        if (!$this->apuestas->contains($apuesta)) {
            $this->apuestas->add($apuesta);
            $apuesta->setSorteo($this);
        }

        return $this;
    }

    public function removeApuesta(Apuesta $apuesta): static
    {
        if ($this->apuestas->removeElement($apuesta)) {
            // set the owning side to null (unless already changed)
            if ($apuesta->getSorteo() === $this) {
                $apuesta->setSorteo(null);
            }
        }

        return $this;
    }

    public function getPremio(): ?string
    {
        return $this->premio;
    }

    public function setPremio(string $premio): static
    {
        $this->premio = $premio;

        return $this;
    }
}
