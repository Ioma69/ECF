<?php

namespace App\Form;                                                                     

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\EqualTo;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Context\ExecutionContext;

class UserType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options)                    /* Création d'un type de formulaire */                                                
    {
        $builder


        ->add("name", TextType::class, 
         ["label" => "Nom", 
         "required" => true, 
         'constraints' 
         => New NotBlank(['message' => "Veuillez renseigner votre nom"])
         ])

         ->add("firstname", TextType::class, 
         ["label" => "Prénom", 
         "required" => true, 
         'constraints' 
         => New NotBlank(['message' => "Veuillez renseigner votre prénom"])
         ])


         ->add("email", TextType::class, 
         ["label" => "Nom d'utilisateur",  
         "required" => true,
         "constraints"          /*Ajout de contraites de validation grace au composant validator*/ 
         => [new Length(["min" => 2, "max" => 80, "minMessage" => "Le nom d'utilisateur doit etre compris entre 2 et 80 caracteres", "maxMessage" => "Le nom d'utilisateur ne doit pas faire plus de 80 caractères"]),
            new NotBlank(['message' => "Le contenu ne doit pas etre vide et/ou doit contenir plus d'un caractere"])]                                                                                                                                                            
        ])
        
        ->add("phone", TextType::class, 
        ["label" => "Numéro de téléphone", 
        "required" => true, 
        'constraints' 
        => New NotBlank(['message' => "Veuillez renseigner votre numéro de téléphone"])
        ])

         ->add("password", PasswordType::class, 
         ["label" => "Mot de passe", 
         "required" => true, 
         'constraints' 
         => New NotBlank(['message' => "Le mot de passe ne doit pas etre vide"])
        ])

        ->add("confirm", PasswordType::class, [
            "label" => "Confirmer le mot de passe",
            "required" => true,
            "constraints" => [
                new NotBlank(["message" => "Le mot de passe ne peut pas être vide !"]),
                new Callback(['callback' => function ($value, ExecutionContext $ec) {
                    if ($ec->getRoot()['password']->getViewData() !== $value) {
                        $ec->addViolation("Les mots de passe doivent être identiques !");
                    }
                }])
            ]
        ]);
}

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => User::class,
            'csrf_protection' => true,                          /* securise le formulaire*/ 
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'picdishes_item',
        ]);
    }
}
    