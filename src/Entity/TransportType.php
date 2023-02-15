<?php

namespace App\Entity;

use App\Repository\TransportTypeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransportTypeRepository::class)]
class TransportType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $compensation = null;

    #[ORM\Column(nullable: true)]
    private ?int $double_threshold = null;

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

    public function getCompensation(): ?float
    {
        return $this->compensation;
    }

    public function setCompensation(float $compensation): self
    {
        $this->compensation = $compensation;

        return $this;
    }

    public function getDoubleThreshold(): ?int
    {
        return $this->double_threshold;
    }

    public function setDoubleThreshold(?int $double_threshold): self
    {
        $this->double_threshold = $double_threshold;

        return $this;
    }
}
