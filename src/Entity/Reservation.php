<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column]
    private ?int $flatware = null;

    #[ORM\Column]
    private ?dateTime $reservationDate = null;

    #[ORM\Column]
    private ?dateTime $reservationHour = null;

    #[ORM\Column]
    private ?string $allergy = null;


    #[ORM\ManyToOne(targetEntity: "App\Entity\User", inversedBy: "reservationUser")]
    #[ORM\JoinColumn(nullable:false)]
    private $reservationUser;


    #[ORM\ManyToOne(targetEntity: "App\Entity\Visitor", inversedBy: "reservationVisitor")]
    #[ORM\JoinColumn(nullable:false)]
    private $reservationVisitor;

    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * Get the value of flatware
     */
    public function getFlatware(): ?int
    {
        return $this->flatware;
    }

    /**
     * Set the value of flatware
     */
    public function setFlatware(?int $flatware): self
    {
        $this->flatware = $flatware;

        return $this;
    }

    /**
     * Get the value of reservationDate
     */
    public function getReservationDate(): ?dateTime
    {
        return $this->reservationDate;
    }

    /**
     * Set the value of reservationDate
     */
    public function setReservationDate(?dateTime $reservationDate): self
    {
        $this->reservationDate = $reservationDate;

        return $this;
    }

    /**
     * Get the value of reservationHour
     */
    public function getReservationHour(): ?dateTime
    {
        return $this->reservationHour;
    }

    /**
     * Set the value of reservationHour
     */
    public function setReservationHour(?dateTime $reservationHour): self
    {
        $this->reservationHour = $reservationHour;

        return $this;
    }

    /**
     * Get the value of allergy
     */
    public function getAllergy(): ?string
    {
        return $this->allergy;
    }

    /**
     * Set the value of allergy
     */
    public function setAllergy(?string $allergy): self
    {
        $this->allergy = $allergy;

        return $this;
    }

    /**
     * Get the value of reservationVisitor
     */
    public function getReservationVisitor()
    {
        return $this->reservationVisitor;
    }

    /**
     * Set the value of reservationVisitor
     */
    public function setReservationVisitor($reservationVisitor): self
    {
        $this->reservationVisitor = $reservationVisitor;

        return $this;
    }

    /**
     * Get the value of reservationUser
     */
    public function getReservationUser()
    {
        return $this->reservationUser;
    }

    /**
     * Set the value of reservationUser
     */
    public function setReservationUser($reservationUser): self
    {
        $this->reservationUser = $reservationUser;

        return $this;
    }
}