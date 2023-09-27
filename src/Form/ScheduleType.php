<?php

namespace App\Form;



use App\Entity\Schedule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ScheduleType extends AbstractType
{



    public function buildForm(FormBuilderInterface $builder, array $options): void /* Création d'un type de formulaire */
    {
        $builder

            ->add('openingNoon', TimeType::class, [
                'label' => "Horaire d'ouverture le midi",
                'required' => true,

            ])

            ->add('closingNoon', TimeType::class, [
                'label' => "Horaire de fermeture le midi",
                'required' => true,

            ])

            ->add('openingEvening', TimeType::class, [
                'label' => "Horaire d'ouverture le soir",
                'required' => true,

            ])

            ->add('closingEvening', TimeType::class, [
                'label' => "Horaire de fermeture le soir",
                'required' => true,

            ]);

    }



    public function configureOptions(OptionsResolver $resolver): void
    {

        $resolver->setDefaults([
            'data_class' => Schedule::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'schedule_item',
        ]);
    }
}