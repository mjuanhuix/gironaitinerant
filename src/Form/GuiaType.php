<?php

namespace App\Form;

use App\Entity\Guia;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GuiaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('NIF')
            ->add('mail')
            ->add('telefon')
            ->add('adreca')
            ->add('IBAN')
            ->add('ciutat')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Guia::class,
        ]);
    }
}
