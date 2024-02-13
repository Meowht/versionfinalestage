<?php

namespace App\Form;

use App\Entity\Booking;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewBookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('begin_at', DateTimeType::class, [
            'widget' => 'single_text', // Utilisez 'single_text' au lieu de 'singletext'
            'label' => 'Date de début :',
        ])
        ->add('end_at', DateTimeType::class, [
            'widget' => 'single_text', // Utilisez 'single_text' au lieu de 'singletext'
            'label' => 'Date de fin :',
        ])
        ->add('title', null, [
            'label' => 'Titre :', // Libellé personnalisé pour le champ title
        ])
        ;
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
