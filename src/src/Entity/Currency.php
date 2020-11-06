<?php

namespace App\Entity;

use App\Repository\CurrencyRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CurrencyRepository::class)
 */
class Currency
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=8)
     */
    private $initial_currency;

    /**
     * @ORM\Column(type="string", length=8)
     */
    private $final_currency;

    /**
     * @ORM\Column(type="decimal", precision=20, scale=2)
     */
    private $initial_value;

    /**
     * @ORM\Column(type="decimal", precision=20, scale=2)
     */
    private $final_value;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInitialCurrency(): ?string
    {
        return $this->initial_currency;
    }

    public function setInitialCurrency(string $initial_currency): self
    {
        $this->initial_currency = $initial_currency;

        return $this;
    }

    public function getFinalCurrency(): ?string
    {
        return $this->final_currency;
    }

    public function setFinalCurrency(string $final_currency): self
    {
        $this->final_currency = $final_currency;

        return $this;
    }

    public function getInitialValue(): ?string
    {
        return $this->initial_value;
    }

    public function setInitialValue(string $initial_value): self
    {
        $this->initial_value = $initial_value;

        return $this;
    }

    public function getFinalValue(): ?string
    {
        return $this->final_value;
    }

    public function setFinalValue(string $final_value): self
    {
        $this->final_value = $final_value;

        return $this;
    }
}
