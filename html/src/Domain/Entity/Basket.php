<?php

namespace App\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Domain\Repository\BasketRepository")
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
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\Entity\Client", inversedBy="baskets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\ManyToMany(targetEntity="App\Domain\Entity\ScheduleDate")
     */
    private $scheduleDates;

    /**
     * @ORM\ManyToMany(targetEntity="App\Domain\Entity\TicketPerson")
     */
    private $ticketsPerson;

    public function __construct()
    {
        $this->scheduleDates = new ArrayCollection();
        $this->ticketsPerson = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Collection|ScheduleDate[]
     */
    public function getScheduleDates(): Collection
    {
        return $this->scheduleDates;
    }

    public function addScheduleDate(ScheduleDate $scheduleDate): self
    {
        if (!$this->scheduleDates->contains($scheduleDate)) {
            $this->scheduleDates[] = $scheduleDate;
        }

        return $this;
    }

    public function removeScheduleDate(ScheduleDate $scheduleDate): self
    {
        if ($this->scheduleDates->contains($scheduleDate)) {
            $this->scheduleDates->removeElement($scheduleDate);
        }

        return $this;
    }

    /**
     * @return Collection|TicketPerson[]
     */
    public function getTicketsPerson(): Collection
    {
        return $this->ticketsPerson;
    }

    public function addTicketsPerson(TicketPerson $ticketsPerson): self
    {
        if (!$this->ticketsPerson->contains($ticketsPerson)) {
            $this->ticketsPerson[] = $ticketsPerson;
        }

        return $this;
    }

    public function removeTicketsPerson(TicketPerson $ticketsPerson): self
    {
        if ($this->ticketsPerson->contains($ticketsPerson)) {
            $this->ticketsPerson->removeElement($ticketsPerson);
        }

        return $this;
    }
}
