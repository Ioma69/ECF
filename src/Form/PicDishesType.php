<?php

namespace App\Form;

use App\Entity\PicDishes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PicDishesType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
         ->add("title", TextType::class, ["label" => "title", "required" => true])
         ->add("image", UrlType::class, ["label" => "URL de l'image", "required" => true]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => PicDishes::class
        ]);
    }
}
    