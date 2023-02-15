<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
class Employee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?TransportType $transportType = null;

    #[ORM\Column]
    private ?int $distance = null;

    #[ORM\Column]
    private ?int $workdays = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTransPortType(): ?TransportType
    {
        return $this->transportType;
    }

    public function setTransPortType(?TransportType $transportType): self
    {
        $this->transportType = $transportType;

        return $this;
    }

    public function getDistance(): ?int
    {
        return $this->distance;
    }

    public function setDistance(int $distance): self
    {
        $this->distance = $distance;

        return $this;
    }

    public function getWorkdays(): ?int
    {
        return $this->workdays;
    }

    public function setWorkdays(int $workdays): self
    {
        $this->workdays = $workdays;

        return $this;
    }
}
