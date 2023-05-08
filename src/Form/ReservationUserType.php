<?php

namespace App\Form;

use App\Entity\Reservation;
use App\Entity\Schedule;
use Doctrine\DBAL\Types\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType as TypeDateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ReservationUserType extends AbstractType {
    
 

    public function buildForm(FormBuilderInterface $builder, array $options): void                    /* Création d'un type de formulaire */                                                
    {
        $builder

        ->add('flatware', ChoiceType::class, [
            'choices' => [
                '1 couverts' => 1,
                '2 couverts' => 2,
                '3 couverts' => 3,
                '4 couverts' => 4,
                '5 couverts' => 5,
                '6 couverts' => 6,
                '7 couverts' => 7,
                '8 couverts' => 8,
                '9 couverts' => 9,
                '10 couverts' => 10
            ]
        ])

       /* ->add('reservationDate', DateType::class, [
            'label' => "Date de reservation",
            'widget' => 'single_text',
            'attr' => ['min' => (new \DateTime())->format('d-m-Y')],
            'years' => range(2023, 2023),
            'months' => range(06,12),
            'required' => true,

        ])*/

        ->add('reservationHour', TimeType::class, [
            'label' => "Heure de reservation",
            'required' => true,

        ])

       ->add('reservationDate', TypeDateTimeType::class, [
            'label' => 'Heure de réservation',
            'widget' => 'single_text',
            'view_timezone' => 'Europe/Paris',
            'model_timezone' => 'UTC',
            'years' => range(date('Y'), date('Y') + 1),
            'months' => range(1, 12),
            'days' => range(1, 31),
            'hours' => range(12, 14),
            'minutes' => ['00', '15', '30', '45'],
            'choice_translation_domain' => false,
        ])

        ->add('allergy', ChoiceType::class, [
            'label' => "Type d'allergie",
            'choices' => [
                'Gluten' => 1,
                'Lactose' => 2,
                'Arachide' => 3,
                'Fruits de mer' => 4,
                'Oeuf' => 5,
            ]
            ]);
}



    public function configureOptions(OptionsResolver $resolver): void
    {
        
        $resolver->setDefaults([
            'data_class' => Reservation::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'reservationUser_item',
        ]);
    }
}
