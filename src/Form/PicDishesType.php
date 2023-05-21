<?php

namespace App\Form;

use App\Entity\PicDishes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\Regex;

class PicDishesType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void /* Création d'un type de formulaire */
    {
        $builder
            ->add(
                "title", TextType::class,
                [
                    "label" => "Nom du plat",
                    "required" => true,
                    "constraints" /*Ajout de contraites de validation grace au composant validator*/
                    => [
                        new Length(["min" => 2, "max" => 80, "minMessage" => "Le titre doit etre compris entre 2 et 80 caracteres", "maxMessage" => "Le titre ne doit pas faire plus de 80 caractères"]),
                        new Regex(['pattern' => "/^[A-Za-zÀ-ÿ' ,!\?0-9]+(?:\?[A-Za-zÀ-ÿ' ,!\?0-9]*)?$/", 'message' => "Entrez le nom du plat sans tiret ni caractères spéciaux"]),
                        new NotBlank(['message' => "Le contenu ne doit pas etre vide"])
                    ]
                ]
            )

            ->add("image", FileType::class, [
                "label" => "L'image",
                'mapped' => false,
                "required" => false,
                'constraints' => [
                    new NotBlank(['message' => "Le contenu ne doit pas etre vide"]),
                    new File([
                        'maxSize' => '5M',
                        'mimeTypes' => [
                            'image/jpeg',
                            "image/gif",
                            "image/png",
                            "image/svg+xml",
                            "image/jpg",
                            "image/webp"
                        ],
                        'mimeTypesMessage' => 'Veuillez proposer une image valide.',
                    ])
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            "data_class" => PicDishes::class,
            'csrf_protection' => true,
            /* securise le formulaire*/
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'picdishes_item',
        ]);
    }
}