<?php

namespace App\Form;

use App\Entity\Utilisateur;
use App\Entity\Classe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class UtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('nom')
            // ->add('prenom')
            ->add('email', EmailType::class)
            // ->add('photo_profil')
            // ->add('admin')
            // ->add('statut')
            ->add('id_classe_id', EntityType::class, [
                'class' => Classe::class,
                'choice_label' => 'titre',
                'label' => 'Classe',
                 'placeholder' => '-- Sélectionnez une Classe --',
                'attr' => ['class' => 'mb-8 block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline'],

            ])
            ->add('mot_de_passe', PasswordType::class)
            ->add('submit', SubmitType::class)
        ;
    }

    // public function configureOptions(OptionsResolver $resolver): void
    // {
    //     $resolver->setDefaults([
    //         'data_class' => Utilisateur::class,
    //     ]);
    // }
    public function getDefaultOptions(array $options)
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
