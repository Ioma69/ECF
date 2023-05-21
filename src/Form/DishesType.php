<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\Dishes;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class DishesType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options): void                    /* Création d'un type de formulaire */                                                
    {
        $builder

        ->add('categories', ChoiceType::class, [
            'label' => 'Nom de la catégorie',
            'mapped' => false,
            'choices' => [
                'Entrée' => 'entrée',
                'Plat' => 'plat',
                'Dessert' => 'dessert',
            ],
        ])

        ->add("title", TextType::class, 
         ["label" => "Nom du plat", 
         "required" => true, 
         'constraints' 
         => [ New NotBlank(['message' => "Veuillez renseigner le nom du plat"]),
              New Regex(['pattern' => "/^[A-Za-zÀ-ÿ' ,!\?0-9]+(?:\?[A-Za-zÀ-ÿ' ,!\?0-9]*)?$/", 'message' => "Entrez Le nom du plat sans tirets ni caractères spéciaux"]),
              new Length(["min" => 3, "max" => 80, "minMessage" => "Le nom du plat doit etre compris entre 3 et 80 caracteres", "maxMessage" => "Le nom du plat ne doit pas faire plus de 80 caractères"])
         ]
         ])

         ->add("description", TextareaType::class, 
         ["label" => "Descrition", 
         "required" => true, 
         'constraints' 
         => [ New NotBlank(['message' => "Veuillez renseigner le nom du plat"]),
              New Regex(['pattern' => "/^[A-Za-zÀ-ÿ' ,!\?0-9]+(?:\?[A-Za-zÀ-ÿ' ,!\?0-9]*)?$/", 'message' => "Entrez la description sans tirets ni caractères spéciaux"]),
              new Length(["min" => 3, "max" => 250, "minMessage" => "La description doit etre compris entre 3 et 250 caracteres", "maxMessage" => "La description ne doit pas faire plus de 250 caractères"])
         ]
         ])
         

         ->add("price", MoneyType::class, 
         ["label" => "Prix",  
         "required" => true,
         'attr' => [
            'class' => 'customForm',
        ],                                                                                                                                                                 
    ]);
        
}



    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            "data_class" => Dishes::class,
            'csrf_protection' => true,                          /* securise le formulaire*/ 
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'dishes_item',
        ]);
    }
}
    



