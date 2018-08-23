<?php

namespace App\Form;

use App\Entity\Rdv;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RdvType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('textelibre',
                TextType::class,
                [
                    'label' => 'une remarque importante?',
                    'required' => false,
                ])
            ->add('motif',
                TextType::class,
                [
                    'label' => 'choisir un motif de rdv',
                    'required' => true,
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rdv::class,
        ]);
    }
}
