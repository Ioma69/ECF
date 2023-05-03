<?php

namespace App\Form;


use App\Entity\Dishes;
use App\Entity\Menu;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class MenuType extends AbstractType {
    
 

    public function buildForm(FormBuilderInterface $builder, array $options): void                    /* Création d'un type de formulaire */                                                
    {
        $builder

        ->add('menuTitle', EntityType::class, [
            'label' => 'Nom du plat',
            'class' => Menu::class,
            'required' => true,

        ])

        ->add('menuTitle', EntityType::class, [
            'label' => 'Nom du plat',
            'class' => Dishes::class,
            'choice_label' => 'title',
            'required' => true,
            'placeholder' => 'Sélectionnez un plat existant',
            
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







    