<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: AdminRepository::class)]
class Admin implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;




    #[ORM\OneToMany(targetEntity: "App\Entity\PicDishes", mappedBy: "admin")]

    private $picdishes;



    #[ORM\OneToMany(targetEntity:"App\Entity\Dishes", mappedBy:"admin")]

    private $dishes;



    #[ORM\OneToMany(targetEntity:"App\Entity\Menu", mappedBy:"adminMenu")]

    private $menu;



    #[ORM\OneToMany(targetEntity:"App\Entity\Schedule", mappedBy:"adminSchedule")]

    private Collection $schedule;



    private $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher) {
        $this->passwordHasher = $passwordHasher;
        $this->picdishes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_ADMIN
        $roles[] = 'ROLE_ADMIN';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $this->passwordHasher->hashPassword($this, $password);

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * Get the value of picdishes
     */
    public function getPicdishes()
    {
        return $this->picdishes;
    }

    /**
     * Set the value of picdishes
     */
    public function setPicdishes($picdishes): self
    {
        $this->picdishes = $picdishes;

        return $this;
    }


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
     * Get the value of menu
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * Set the value of menu
     */
    public function setMenu($menu): self
    {
        $this->menu = $menu;

        return $this;
    }

    /**
     * Get the value of schedule
     */
    public function getSchedule(): Collection
    {
        return $this->schedule;
    }

    /**
     * Set the value of schedule
     */
    public function setSchedule(Collection $schedule): self
    {
        $this->schedule = $schedule;

        return $this;
    }
}
