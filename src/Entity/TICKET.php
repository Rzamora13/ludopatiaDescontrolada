<?php

namespace App\Entity;

use App\Repository\TICKETRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TICKETRepository::class)]
class TICKET
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numero = null;

    #[ORM\Column]
    private ?int $estado = null;

    #[ORM\ManyToOne(inversedBy: 'ticket')]
    private ?SORTEO $sorteo = null;

    #[ORM\ManyToOne(inversedBy: 'ticket')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): static
    {
        $this->numero = $numero;

        return $this;
    }

    public function getEstado(): ?int
    {
        return $this->estado;
    }

    public function setEstado(int $estado): static
    {
        $this->estado = $estado;

        return $this;
    }

    public function getSorteo(): ?SORTEO
    {
        return $this->sorteo;
    }

    public function setSorteo(?SORTEO $sorteo): static
    {
        $this->sorteo = $sorteo;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
