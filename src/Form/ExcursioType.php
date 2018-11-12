<?php

namespace App\Form;

use App\Entity\Excursio;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;



use Symfony\Component\Form\Extension\Core\Type\DateType;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use Symfony\Component\Form\Extension\Core\Type\FileType;

Use Symfony\Component\Form\Extension\Core\Type\NumberType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;



use Doctrine\ORM\EntityRepository;


class ExcursioType extends AbstractType{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {





        $builder
           ->add('data', DateType::class, array(
                'widget' => 'single_text',
                "label"=>"Data",
                "required"=>"required",
                'format' => 'yyyy-MM-dd',
                "attr"=> ["class"=>" form-control js-datepicker"]

            ))
            ->add('horaris', TextAreaType::class, array(
                "label"=>"Ruta i horaris",
                "required"=>false,
                "attr"=>array(
                    "class"=>"form-control"
                )
            ))

            ->add('escola')
            ->add('professors')
            ->add('curs')
            ->add('ruta')


            ->add('numero_alumnes',NumberType::class, array(
                "label"=>"Número d'alumnes",
                "required"=>false,
                "attr"=>array(
                    "class"=>"form-control",
                    "maxlength"=>3
                )
            ) )
            ->add('import',NumberType::class, array(
                "label"=>"Import",
                "required"=>false,
                "attr"=>array(
                    "class"=>"form-control",
                    "maxlength"=>7
                )
            ) )

            ->add("factura_signada", FileType::class, array(
                "required"=>false,
                "label"=>"Factura signada",
                "data_class"=>null,
                "attr"=>array(
                    "class"=>"form-control"
                )
            ))



            ->add('data_pagament', DateType::class, array(
                'widget' => 'single_text',
                "label"=>"Data de pagament",
                "required"=>false,
                'format' => 'yyyy-MM-dd',
                "attr"=> ["class"=>"form-control js-datepicker"]
            ))


            ->add("Guardar", SubmitType::class, array(
                "attr" => array(
                    "class" => "btn btn-success"
                )
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Excursio::class,
        ]);
    }
}


