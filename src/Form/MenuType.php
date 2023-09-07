<?php

namespace App\Form;


use App\Entity\Dishes;
use App\Entity\Menu;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class MenuType extends AbstractType {
    
 

    public function buildForm(FormBuilderInterface $builder, array $options): void                    /* Création d'un type de formulaire */                                                
    {
        $builder

        ->add('menuTitle', TextType::class, [
            'label' => 'Nom du Menu',
            'required' => true,
            'constraints' 
         => [ New NotBlank(['message' => "Veuillez renseigner le nom du plat"]),
              New Regex(['pattern' => "/^([a-zA-ZÀ-ÿ\s'.,!?]|\p{L})*$/", 'message' => "Entrez Le nom du menu sans tirets ni caractères spéciaux"]),
              new Length(["min" => 3, "max" => 80, "minMessage" => "La description doit etre compris entre 3 et 80 caracteres", "maxMessage" => "La description ne doit pas faire plus de 80 caractères"])
         ]

        ])

        ->add('title', EntityType::class, [
            'label' => 'Plats',
            'class' => Dishes::class,
            'multiple' => true, // Permet de sélectionner plusieurs plats
            'expanded' => true, // Affiche les plats sous forme de cases à cocher
            'mapped' => false, 
        ])

        

         ->add("description", TextareaType::class, 
         ["label" => "Description", 
         "required" => true,
         'constraints' 
         => [ New NotBlank(['message' => "Veuillez renseigner le nom du plat"]),
              New Regex(['pattern' => "/^([a-zA-ZÀ-ÿ\s'.,!?]|\p{L})*$/", 'message' => "Entrez la description sans tirets ni caractères spéciaux"]),
              new Length(["min" => 3, "max" => 255, "minMessage" => "La description doit etre compris entre 3 et 255 caracteres", "maxMessage" => "La description ne doit pas faire plus de 255 caractères"])
         ] 
         ])
         
        
         ->add("price", MoneyType::class, 
         ["label" => "Prix",  
         "required" => true,                                                                                                                                                                 
    ]);
        
}



    public function configureOptions(OptionsResolver $resolver): void
    {
        
        $resolver->setDefaults([
            'data_class' => Menu::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'menu_item',
        ]);
    }
}







    