<?php

namespace App\Form;                                                                     

use App\Entity\PicDishes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Url;

class PicDishesType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options)                    /* Création d'un type de formulaire */                                                
    {
        $builder
         ->add("title", TextType::class, 
         ["label" => "Titre", 
         "required" => true,
         "constraints"          /*Ajout de contraites de validation grace au composant validator*/ 
         => [new Length(["min" => 2, "max" => 80, "minMessage" => "Le titre doit etre compris entre 2 et 80 caracteres", "maxMessage" => "Le titre ne doit pas faire plus de 80 caractères"]),
            new NotBlank(['message' => "Le contenu ne doit pas etre vide"])]                                                                                                                                                            
        ])
        
         ->add("image", UrlType::class, 
         ["label" => "URL de l'image", 
         "required" => true, 
         'constraints' 
         => [new Url(['message' => "L'image doit être une URL valide"]),
            New NotBlank(['message' => "Le contenu ne doit pas etre vide"])]
         ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => PicDishes::class,
            'csrf_protection' => true,                          /* securise le formulaire*/ 
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'picdishes_item',
        ]);
    }
}
    