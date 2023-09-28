<?php

// Gestiones DB

namespace App\Entity;

use App\Repository\ProveedorRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

// Defino la enumeración para poder crear los tipos de proveedor
final class TipoProveedor
{
    // Creamos los 3 tipos que estan permitidos
    public const HOTEL = 'Hotel';
    public const PISTA = 'Pista';
    public const COMPLEMENTARIO = 'Complementario';

    private const ALLOWED_TYPES = [
        self::HOTEL,
        self::PISTA,
        self::COMPLEMENTARIO,
    ];

    // Funciones para obtener los tipos
    public static function getAllowedTypes(): array
    {
        return self::ALLOWED_TYPES;
    }

    // Función de validar
    public static function isValid(string $type): bool
    {
        return in_array($type, self::ALLOWED_TYPES, true);
    }
};

#[ORM\Entity(repositoryClass: ProveedorRepository::class)]
class Proveedor
{
    // Atributos de Proveedor
    // ID
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    // Nombre
    #[ORM\Column(length: 80)]
    private ?string $nombre = null;

    // Correo electrónico
    #[ORM\Column(length: 255)]
    private ?string $email = null;

    // Telefono
    #[ORM\Column]
    private ?int $telefono = null;

    // Tipo de proveedor
    #[ORM\Column(length:80)]
    private ?string $tipoProveedor = null;

    // Actividad
    #[ORM\Column]
    private ?bool $activo = null;

    // Última actualización
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $lastUpdate = null;    

    // Fecha de creación
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createDateTime = null;    

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
        // Verifica si el tipo es válido usando la clase TipoProveedor
        if (!TipoProveedor::isValid($tipoProveedor)) {
            throw new \InvalidArgumentException('Tipo de proveedor no válido');
        }

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

    public function getCreateDateTime(): ?\DateTimeInterface
    {
        return $this->createDateTime;
    }

    public function setCreateDateTime(\DateTimeInterface $createDateTime): static
    {
        $this->createDateTime = $createDateTime;

        return $this;
    }
}
