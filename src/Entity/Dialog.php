<?php

namespace App\Entity;

use App\Repository\DialogRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DialogRepository::class)]
class Dialog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $S = null;

    #[ORM\Column(type: Types::JSON)]
    private array $P = [];

    #[ORM\Column(length: 255)]
    private ?string $O = null;

    #[ORM\Column(type: Types::JSON)]
    private array $A = [];

    #[ORM\Column(type: Types::JSON)]
    private array $B = [];

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getS(): ?string
    {
        return $this->S;
    }

    /**
     * @param string|null $S
     */
    public function setS(?string $S): void
    {
        $this->S = $S;
    }

    /**
     * @return array
     */
    public function getP(): array
    {
        return $this->P;
    }

    /**
     * @param array $P
     */
    public function setP(array $P): void
    {
        $this->P = $P;
    }

    /**
     * @return string|null
     */
    public function getO(): ?string
    {
        return $this->O;
    }

    /**
     * @param string|null $O
     */
    public function setO(?string $O): void
    {
        $this->O = $O;
    }

    /**
     * @return array
     */
    public function getA(): array
    {
        return $this->A;
    }

    /**
     * @param array $A
     */
    public function setA(array $A): void
    {
        $this->A = $A;
    }

    /**
     * @return array
     */
    public function getB(): array
    {
        return $this->B;
    }

    /**
     * @param array $B
     */
    public function setB(array $B): void
    {
        $this->B = $B;
    }


}
