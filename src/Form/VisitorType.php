<?php

namespace App\Form;

use App\Entity\Reservation;
use App\Entity\Schedule;
use App\Entity\Visitor;
use DateTime;
use Doctrine\DBAL\Types\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType as TypeDateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class VisitorType extends AbstractType {
    
 

    public function buildForm(FormBuilderInterface $builder, array $options): void                    /* Création d'un type de formulaire */                                                
    {
        $builder

        ->add("name", TextType::class, 
        ["label" => "Nom", 
        "required" => true, 
        'constraints' 
        => [ New NotBlank(['message' => "Veuillez renseigner votre nom"]),
             New Regex(['pattern' => '/^[A-Z]{2,}/', 'message' => "Entrez votre nom en majuscule"]),
             new Length(["min" => 3, "max" => 50, "minMessage" => "Le nom d'utilisateur doit etre compris entre 3 et 50 caracteres", "maxMessage" => "Le nom d'utilisateur ne doit pas faire plus de 50 caractères"])
        ]
        ])
        
            ->add("email", TextType::class, [
                "label" => "email",
                "required" => true,
                "constraints" => [
                    new Length(["min" => 2, "max" => 180, "minMessage" => "L'email ne doit pas faire moins de 2 caractères", "maxMessage" => "L'email ne doit pas faire plus de 180 caractères"]),
                    new NotBlank(["message" => "L'email ne doit pas être vide !"])
                ]
            ])

            ->add("phone", TextType::class, 
            ["label" => "Numéro de téléphone", 
            "required" => true, 
            'constraints' 
            => [New NotBlank(['message' => "Veuillez renseigner votre numéro de téléphone"]),
            new Length(["min" => 10, "max" => 10, "exactMessage" => "Le numéro de téléphone doit contenir 10 caractères '0XXXXXXXXX'"]),
            New Regex(['pattern' => '/0[1-9]\d{8}/', 'message' => "Entrez un numéro de téléphone avec ce format '0XXXXXXXXX' sans tirets ni espaces"])
             ]
                ]);
}



    public function configureOptions(OptionsResolver $resolver): void
    {
        
        $resolver->setDefaults([
            'data_class' => Visitor::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'Visitor_item',
        ]);
    }
}
