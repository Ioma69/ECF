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
    private ?string $name = null;

    
    public function getId(): ?int
    {
        return $this->id;
    }


    //#[ORM\OneToMany(targetEntity:"App\Entity\Dishes", mappedBy:"category")]

    //private $dishes;
 


    /**
     * Get the value of dishes
     */
    public function getDishes()
    {
        return $this->dishes;
    }

    /**
     * Set the value of dishes
     */
    public function setDishes($dishes): self
    {
        $this->dishes = $dishes;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
