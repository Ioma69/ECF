<?php

namespace App\Form;

use App\Entity\Dishes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class DishesType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options)                    /* Création d'un type de formulaire */                                                
    {
        $builder


        ->add("title", TextType::class, 
         ["label" => "Titre", 
         "required" => true, 
         ])

         ->add("description", TextareaType::class, 
         ["label" => "Descrition", 
         "required" => true, 
         ])
         


         ->add("price", MoneyType::class, 
         ["label" => "Prix",  
         "required" => true,                                                                                                                                                                 
        ]);
        
      
}



    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => Dishes::class,
            'csrf_protection' => true,                          /* securise le formulaire*/ 
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'dishes_item',
        ]);
    }
}
    



/*'constraints' 
         /*=> [ New NotBlank(['message' => "Veuillez renseigner votre nom"]),
              New Regex(['pattern' => '/^[A-Z]{2,}/', 'message' => "Entrez votre nom en majuscule"]),
              new Length(["min" => 3, "max" => 50, "minMessage" => "Le nom d'utilisateur doit etre compris entre 3 et 50 caracteres", "maxMessage" => "Le nom d'utilisateur ne doit pas faire plus de 50 caractères"])
         ]
         
         /*=> [New NotBlank(['message' => "Veuillez renseigner votre prénom"]),
         New Regex(['pattern' => '/^[A-Z][a-z]{2,}/', 'message' => "Entrez votre prénom en commencant par une majuscule"]),
         new Length(["min" => 3, "max" => 50, "minMessage" => "Le nom d'utilisateur doit etre compris entre 3 et 50 caracteres", "maxMessage" => "Le nom d'utilisateur ne doit pas faire plus de 50 caractères"])
         ]
         
          /*Ajout de contraites de validation grace au composant validator*/ 
        /* => [new Length(["min" => 2, "max" => 80, "minMessage" => "Le nom d'utilisateur doit etre compris entre 2 et 80 caracteres", "maxMessage" => "Le nom d'utilisateur ne doit pas faire plus de 80 caractères"]),
            new NotBlank(['message' => "Le contenu ne doit pas etre vide et/ou doit contenir plus d'un caractere"])] */