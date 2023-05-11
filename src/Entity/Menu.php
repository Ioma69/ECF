<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
#[UniqueEntity("menuTitle", message: "Nom de menu deja existant")]
class Menu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(length: 80)]
    private ?string $menuTitle = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $price = null;



    #[ORM\ManyToMany(targetEntity: "App\Entity\Dishes", mappedBy: "menu")]
    
    private Collection $meal;
   

    #[ORM\ManyToOne(targetEntity:"App\Entity\Admin", inversedBy:"menu")]
    #[ORM\JoinColumn(name: "admin_id", referencedColumnName: "id")]
    private $adminMenu;



    public function __construct()
    {
        $this->meal = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getMenuTitle();
    }



    public function addMeal(Dishes $dishes): self
    {
        if (!$this->meal->contains($dishes)) {
            $this->meal[] = $dishes;
            $dishes->addMenu($this);
        }
    
        return $this;
    }
    
    
    public function removeMeal(Dishes $meal): self
    {
        if ($this->meal->removeElement($meal)) {
            $meal->removeMenu($this);
        }
        return $this;
    }
    // ... getters and setters for properties

    public function getId(): ?int
    {
        return $this->id;
    }

       /**
     * Get the value of menuTitle
     */
    public function getMenuTitle(): ?string
    {
        return $this->menuTitle;
    }

    /**
     * Set the value of menuTitle
     */
    public function setMenuTitle(?string $menuTitle): self
    {
        $this->menuTitle = $menuTitle;

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
    public function getMeal(): Collection
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