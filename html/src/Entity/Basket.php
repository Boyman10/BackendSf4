<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BasketRepository")
 */
class Basket
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateBasket;

    /**
     * @ORM\Column(type="integer")
     */
    private $client;

    public function getId()
    {
        return $this->id;
    }

    public function getDateBasket(): ?\DateTimeInterface
    {
        return $this->dateBasket;
    }

    public function setDateBasket(\DateTimeInterface $dateBasket): self
    {
        $this->dateBasket = $dateBasket;

        return $this;
    }

    public function getClient(): ?int
    {
        return $this->client;
    }

    public function setClient(int $client): self
    {
        $this->client = $client;

        return $this;
    }
}
