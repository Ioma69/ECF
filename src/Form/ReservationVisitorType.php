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
use App\Form\VisitorType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class ReservationVisitorType extends AbstractType
{



    public function buildForm(FormBuilderInterface $builder, array $options): void /* Création d'un type de formulaire */
    {
        $builder

            ->add('flatware', ChoiceType::class, [
                'choices' => [
                    '1 couvert' => 1,
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


            ->add('reservationDate', DateType::class, [
                'label' => "Date de reservation",
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'attr' => ['min' => (new DateTime())->format('Y-m-d')],
                'years' => range(2023, 2024),
                'months' => range(06, 12),
                'required' => true,
                'constraints' => [
                    new GreaterThan([
                        'value' => 'yesterday',
                        'message' => 'La date de réservation doit être postérieure à la date du jour.',
                    ]),
                ],
            ])



            ->add('reservationHour', ChoiceType::class, [
                'label' => 'Heure de réservation',
                'choices' => [
                    '- Midi' => [
                        '12h15' => new DateTime('12:15:00'),
                        '12h30' => new DateTime('12:30:00'),
                        '12h45' => new DateTime('12:45:00'),
                        '13h00' => new DateTime('13:00:00'),
                        '13h15' => new DateTime('13:15:00'),
                        '13h30' => new DateTime('13:30:00'),
                        '13h45' => new DateTime('13:45:00'),
                    ],
                    '- Soir' => [
                        '20h15' => new DateTime('19:15:00'),
                        '20h30' => new DateTime('19:30:00'),
                        '20h45' => new DateTime('19:45:00'),
                        '21h00' => new DateTime('20:00:00'),
                        '21h15' => new DateTime('20:15:00'),
                        '21h30' => new DateTime('20:30:00'),
                        '21h45' => new DateTime('20:45:00'),
                    ],
                ],
                'expanded' => false,
                'multiple' => false,
                'choice_attr' => function ($choice, $key, $value) {
                    return ['class' => 'btn btn-outline-primary'];
                },
            ])



            ->add('allergy', ChoiceType::class, [
                'label' => "Type d'allergie",
                'choices' => [
                    'Gluten' => 'Gluten',
                    'Lactose' => 'Lactose',
                    'Arachide' => 'Arachide',
                    'Fruits de mer' => 'Fruits de mer',
                    'Oeuf' => 'Oeuf',
                ],
                'multiple' => true,
                'expanded' => true,
            ]);


    }



    public function configureOptions(OptionsResolver $resolver): void
    {

        $resolver->setDefaults([
            'data_class' => Reservation::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'reservationVisitor_item',
        ]);
    }
}