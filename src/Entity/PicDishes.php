<?php 

namespace App\Entity;

use Symfony\Component\Form\Extension\Core\Type\UrlType;

class PicDishes {
    private int $id;
    private string $title;

    private string $image;
    
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