<?php 

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;                            /* Création d'une entité dans la BDD via doctrine*/ 

#[ORM\Entity()]
#[ORM\Table(name: "picdishes")]

class PicDishes {

    #[ORM\Id()]
    #[ORM\GeneratedValue(strategy:"AUTO")]
    #[ORM\Column(type:"integer")]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 80)]
    private ?string $title = null;

    #[ORM\Column(type: "text")]
    private ?string $image = null;


    #[ORM\ManyToOne(targetEntity: "App\Entity\Admin", inversedBy: "picdishes")]
    #[ORM\JoinColumn(name:"admin_id", referencedColumnName:"id")]
   
    private $admin;


    
    public function getId(): int
    {
        return $this->id;
    }

  
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }
  
    

    public function getTitle(): string
    {
        return $this->title;
    }

  

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }



    public function getImage(): string
    {
        return $this->image;
    }



    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

  

    public function getAdmin()
    {
        return $this->admin;
    }

    

    public function setAdmin($admin): self
    {
        $this->admin = $admin;

        return $this;
    }

  
}