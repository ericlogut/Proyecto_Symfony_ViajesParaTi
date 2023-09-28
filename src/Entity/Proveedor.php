<?php

namespace App\Entity;

use App\Repository\ProveedorRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

// Creo la enumeración que será el tipo de proveedor 
enum TipoProveedor: string {
    case Hotel = 'Hotel';
    case Pista = 'Pista';
    case Complementario = 'Complementario';
}

#[ORM\Entity(repositoryClass: ProveedorRepository::class)]
class Proveedor
{
    // Atributos de Proveedor
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(length: 80)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column]
    private ?int $telefono = null;

    #[ORM\Column(length:80)]
    private ?string $tipoProveedor = null;

    #[ORM\Column]
    private ?bool $activo = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $lastUpdate = null;    

    // Getters y setters
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTelefono(): ?int
    {
        return $this->telefono;
    }

    public function setTelefono(int $telefono): static
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getTipoProveedor(): ?string
    {
        return $this->tipoProveedor;
    }

    public function setTipoProveedor(string $tipoProveedor): self
    {
        $this->tipoProveedor = $tipoProveedor;

        return $this;
    }

    public function isActivo(): ?bool
    {
        return $this->activo;
    }

    public function setActivo(bool $activo): static
    {
        $this->activo = $activo;

        return $this;
    }

    public function getLastUpdate(): ?\DateTimeInterface
    {
        return $this->lastUpdate;
    }

    public function setLastUpdate(\DateTimeInterface $lastUpdate): static
    {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }
}
