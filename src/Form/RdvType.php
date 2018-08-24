<?php

namespace App\Form;

use App\Entity\Motif;
use App\Entity\Rdv;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
                EntityType::class,
                array(
                    'class' => Motif::class,
                    'choice_label' => 'acte'
                )
            );
        ;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rdv::class,
        ]);
    }
}
