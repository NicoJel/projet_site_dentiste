<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',
                TextType::class,
                [
                    'label' => 'Nom'
                ]
            )
            ->add('prenom',
                TextType::class,
                [
                    'label' => 'Prénom'
                ]
            )
            ->add('dateNaissance',
                BirthdayType::class,
                [
                    'label' => 'Date de Naissance',
                ]
            )
            ->add('civilite',
                ChoiceType::class,
                [
                    'label' => 'Civilité',
                    'choices' => [
                        'Mr' => 'Mr',
                        'Mme' => 'Mme'
                    ],
                    'expanded' => true
                ]
)
            ->add('telephone',
                TextType::class,
                [
                    'label' => 'Téléphone'
                ]
            )
            ->add('adresse',
                TextType::class,
                [
                    'label' => 'Adresse'
                ]
            )
            ->add('mail',
                EmailType::class,
                [
                    'label' => 'Email'
                ]
            )
            ->add('commentaire',
                TextareaType::class,
                [
                    'label' => 'Commentaire',
                    'required' => false
                ]
            )
            ->add(
                'plainPassword',
                // -- 2 champs qui doivent avoir la même valeur
                RepeatedType::class,
                [
                    'type' => PasswordType::class,
                    // options du 1er des deux champs
                    'first_options' => [
                        'label' => 'Mot de passe'
                    ],
                    // options du 2e
                    'second_options' => [
                        'label' => 'Confirmation du mot de passe'
                    ],
                    'invalid_message' => 'Les deux mots de passe ne sont pas identiques'
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}