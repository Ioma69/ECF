<?php

namespace App\Form;

use App\Entity\Admin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add("email", TextType::class, [
                "label" => "email",
                "required" => true,
                "constraints" => [
                    new Length(["min" => 2, "max" => 180, "minMessage" => "L'email ne doit pas faire moins de 2 caractères", 
                    "maxMessage" => "L'email ne doit pas faire plus de 180 caractères"]),
                    new NotBlank(["message" => "L'email ne doit pas être vide !"])
                ]
            ])
            ->add("password", PasswordType::class, [
                "label" => "Mot de passe",
                "required" => true,
                "constraints" => [
                    new NotBlank(["message" => "Le mot de passe ne peut pas être vide !"]),
                    new Regex(['pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*]).{8,}$/',
                    'message' => 
                    "Le mot de passe doit contenir au moins 8 caractères dont un numéro, 
                    une majuscule et un caractère spécial (!,@,#,$,%,^,&,*)"])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            "data_class" => Admin::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'admin_item',
        ]);
    }
}