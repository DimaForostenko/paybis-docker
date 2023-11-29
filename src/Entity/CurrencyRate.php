<?php

namespace App\Entity;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use App\Repository\CurrencyRateRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Validator\Constraints as Assert;
use Doctrine\DBAL\Types\TimeImmutableType;
use phpDocumentor\Reflection\Types\Integer;

#[ORM\Entity(repositoryClass: CurrencyRateRepository::class)]
class CurrencyRate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER, updatable: false)]
    private int $id;

    #[ORM\Column(type: Types::DATE_IMMUTABLE, updatable: false)]
    #[Assert\DateRequirements]
    private DateTimeImmutable $date;

    #[ORM\Column(type: Types::STRING, length: 3, updatable: false)]
    #[Assert\RateCurrencyRequirements]
    private string $base;

    #[ORM\Column(type: Types::DECIMAL, precision: 16, scale: 8, updatable: false)]
   
    private string $rate;

    #[ORM\Column(type: Types::STRING, length: 6, updatable: false)]
    
    private string $currency;

    // #[ORM\Column(type:TYPES::TIME_IMMUTABLE, length:2)]
    // private $timestamp;

    public function getId(): int
    {
        return $this->id;
    }
    public function getBase(): string
    {
        return $this->base;
    }

    public function setBase(string $base): self
    {
        $this->base = $base;

        return $this;
    }
    public function getRate(): string
    {
        return $this->rate;
    }

    public function setRate(string $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function getDate(): DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(DateTimeImmutable $date): self
    {
        $this->date = $date;

        return $this;
    }
 
}



