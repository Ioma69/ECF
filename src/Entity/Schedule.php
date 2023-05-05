<?php

namespace App\Entity;

use App\Repository\ScheduleRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Twig\TwigFunction;

#[ORM\Entity(repositoryClass: ScheduleRepository::class)]
class Schedule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column]
    private ?dateTime $openingNoon = null;

    #[ORM\Column]
    private ?dateTime $closingNoon = null;

    #[ORM\Column]
    private ?dateTime $openingEvening = null;

    #[ORM\Column]
    private ?dateTime $closingEvening = null;

    public function getId(): ?int
    {
        return $this->id;
    }



    
    #[ORM\ManyToOne(targetEntity:"App\Entity\Admin", inversedBy:"schedule")]

    private $adminSchedule;



  
    /**
     * Get the value of openingNoon
     */
    public function getOpeningNoon(): ?dateTime
    {
        return $this->openingNoon;
    }

    /**
     * Set the value of openingNoon
     */
    public function setOpeningNoon(?dateTime $openingNoon): self
    {
        $this->openingNoon = $openingNoon;

        return $this;
    }

    /**
     * Get the value of closingNoon
     */
    public function getClosingNoon(): ?dateTime
    {
        return $this->closingNoon;
    }

    /**
     * Set the value of closingNoon
     */
    public function setClosingNoon(?dateTime $closingNoon): self
    {
        $this->closingNoon = $closingNoon;

        return $this;
    }

    /**
     * Get the value of openingEvening
     */
    public function getOpeningEvening(): ?dateTime
    {
        return $this->openingEvening;
    }

    /**
     * Set the value of openingEvening
     */
    public function setOpeningEvening(?dateTime $openingEvening): self
    {
        $this->openingEvening = $openingEvening;

        return $this;
    }

    /**
     * Get the value of closingEvening
     */
    public function getClosingEvening(): ?dateTime
    {
        return $this->closingEvening;
    }

    /**
     * Set the value of closingEvening
     */
    public function setClosingEvening(?dateTime $closingEvening): self
    {
        $this->closingEvening = $closingEvening;

        return $this;
    }

    /**
     * Get the value of adminSchedule
     */
    public function getAdminSchedule()
    {
        return $this->adminSchedule;
    }

    /**
     * Set the value of adminSchedule
     */
    public function setAdminSchedule($adminSchedule): self
    {
        $this->adminSchedule = $adminSchedule;

        return $this;
    }
}
