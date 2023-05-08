<?php

namespace App\Entity;

use App\Repository\VisitorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VisitorRepository::class)]
class Visitor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

   
    #[ORM\Column(length: 180)]
    private ?string $email = null;

    #[ORM\Column(length: 50)]
    private string $phone;

    #[ORM\OneToMany(targetEntity: "App\Entity\Reservation", mappedBy: "visitor")]

    private $reservationVisitor;


    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * Get the value of email
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    

    /**
     * Get the value of phone
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     */
    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

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
}
