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


class MenuType extends AbstractType {
    
 

    public function buildForm(FormBuilderInterface $builder, array $options): void                    /* Création d'un type de formulaire */                                                
    {
        $builder

        ->add('menuTitle', TextType::class, [
            'label' => 'Nom du Menu',
            'required' => true,

        ])

        ->add('title', EntityType::class, [
            'label' => 'Nom du plat',
            'class' => Dishes::class,
            'required' => true,
            'mapped' => false
            
        ])

         ->add("description", TextareaType::class, 
         ["label" => "Description", 
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







    