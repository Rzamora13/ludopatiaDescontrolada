<?php

namespace App\Form;

use App\Entity\SORTEO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SORTEOType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
            ->add('fecha_inicio')
            ->add('fecha_fin')
            ->add('precio_ticket')
            ->add('ticket_totales')
            ->add('premio')
            ->add('numero_premiado')
            ->add('id_ganador')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SORTEO::class,
        ]);
    }
}
