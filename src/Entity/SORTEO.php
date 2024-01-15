<?php

namespace App\Entity;

use App\Repository\SORTEORepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SORTEORepository::class)]
class SORTEO
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fecha_inicio = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fecha_fin = null;

    #[ORM\Column]
    private ?int $precio_ticket = null;

    #[ORM\Column]
    private ?int $ticket_totales = null;

    #[ORM\Column(length: 255)]
    private ?string $premio = null;

    #[ORM\Column(nullable: true)]
    private ?int $numero_premiado = null;

    #[ORM\Column(nullable: true)]
    private ?int $id_ganador = null;

    #[ORM\OneToMany(mappedBy: 'sorteo', targetEntity: TICKET::class)]
    private Collection $ticket;

    public function __construct()
    {
        $this->ticket = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

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

    public function getTicketTotales(): ?int
    {
        return $this->ticket_totales;
    }

    public function setTicketTotales(int $ticket_totales): static
    {
        $this->ticket_totales = $ticket_totales;

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

    public function getNumeroPremiado(): ?int
    {
        return $this->numero_premiado;
    }

    public function setNumeroPremiado(?int $numero_premiado): static
    {
        $this->numero_premiado = $numero_premiado;

        return $this;
    }

    public function getIdGanador(): ?int
    {
        return $this->id_ganador;
    }

    public function setIdGanador(?int $id_ganador): static
    {
        $this->id_ganador = $id_ganador;

        return $this;
    }

    /**
     * @return Collection<int, TICKET>
     */
    public function getTicket(): Collection
    {
        return $this->ticket;
    }

    public function addTicket(TICKET $ticket): static
    {
        if (!$this->ticket->contains($ticket)) {
            $this->ticket->add($ticket);
            $ticket->setSorteo($this);
        }

        return $this;
    }

    public function removeTicket(TICKET $ticket): static
    {
        if ($this->ticket->removeElement($ticket)) {
            // set the owning side to null (unless already changed)
            if ($ticket->getSorteo() === $this) {
                $ticket->setSorteo(null);
            }
        }

        return $this;
    }
}
