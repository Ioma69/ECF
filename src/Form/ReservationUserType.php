<?php

namespace App\Form;

use App\Entity\Reservation;
use App\Entity\Schedule;
use Doctrine\DBAL\Types\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ReservationUserType extends AbstractType {
    
 

    public function buildForm(FormBuilderInterface $builder, array $options): void                    /* Création d'un type de formulaire */                                                
    {
        $builder

        ->add('flatware', IntegerType::class, [
            'label' => "Nombre de couverts",
            'required' => true,

        ])

        ->add('reservationDate', DateType::class, [
            'label' => "Date de reservation",
            'widget' => 'single_text',
            'attr' => ['min' => (new \DateTime())->format('d-m-Y')],
            'years' => range(2023, 2023),
            'months' => range(06,12),
            'required' => true,

        ])

        ->add('reservationHour', TimeType::class, [
            'label' => "Heure de reservation",
            'required' => true,

        ])

        ->add('allergy', TextType::class, [
            'label' => "type d'allegie",
            'required' => true,

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
