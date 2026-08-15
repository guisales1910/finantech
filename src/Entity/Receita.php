<?php

namespace App\Entity;

use App\Repository\ReceitaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReceitaRepository::class)]
class Receita
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $descricao = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $valor = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $data = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): static
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getValor(): ?string
    {
        return $this->valor;
    }

    public function setValor(string $valor): static
    {
        $this->valor = $valor;

        return $this;
    }

    public function getData(): ?\DateTime
    {
        return $this->data;
    }

    public function setData(\DateTime $data): static
    {
        $this->data = $data;

        return $this;
    }
}
