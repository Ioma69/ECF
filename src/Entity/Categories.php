<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $starter = null;

    #[ORM\Column(length: 50)]
    private ?string $dishe = null;

    #[ORM\Column(length: 50)]
    private ?string $dessert = null;
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the value of starter
     */
    public function getStarter(): ?string
    {
        return $this->starter;
    }

    /**
     * Set the value of starter
     */
    public function setStarter(?string $starter): self
    {
        $this->starter = $starter;

        return $this;
    }

    /**
     * Get the value of dishe
     */
    public function getDishe(): ?string
    {
        return $this->dishe;
    }

    /**
     * Set the value of dishe
     */
    public function setDishe(?string $dishe): self
    {
        $this->dishe = $dishe;

        return $this;
    }

    /**
     * Get the value of dessert
     */
    public function getDessert(): ?string
    {
        return $this->dessert;
    }

    /**
     * Set the value of dessert
     */
    public function setDessert(?string $dessert): self
    {
        $this->dessert = $dessert;

        return $this;
    }
}
