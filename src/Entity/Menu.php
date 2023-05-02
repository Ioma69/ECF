<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
class Menu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(length: 80)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $price = null;



    #[ORM\ManyToMany(targetEntity: "App\Entity\Dishes", inversedBy: "menu")]
    #[ORM\JoinTable(name: "menu_dishes")] 
    #[ORM\JoinColumn(name: "menu_id", referencedColumnName: "id")] 
    #[ORM\InverseJoinColumn(name: "dish_id", referencedColumnName: "id")]
    private $meal;
   

    #[ORM\ManyToOne(targetEntity:"App\Entity\Admin", inversedBy:"menu")]
    #[ORM\JoinColumn(name: "admin_id", referencedColumnName: "id")]
    private $adminMenu;



    public function __construct()
    {
        $this->meal = new ArrayCollection();
    }

    // ... getters and setters for properties

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the value of title
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Set the value of title
     */
    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of price
     */
    public function getPrice(): ?int
    {
        return $this->price;
    }

    /**
     * Set the value of price
     */
    public function setPrice(?int $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of meal
     */
    public function getMeal()
    {
        return $this->meal;
    }

    /**
     * Set the value of meal
     */
    public function setMeal($meal): self
    {
        $this->meal = $meal;

        return $this;
    }

    /**
     * Get the value of adminMenu
     */
    public function getAdminMenu()
    {
        return $this->adminMenu;
    }

    /**
     * Set the value of adminMenu
     */
    public function setAdminMenu($adminMenu): self
    {
        $this->adminMenu = $adminMenu;

        return $this;
    }
}
