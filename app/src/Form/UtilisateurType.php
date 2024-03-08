<?php

namespace App\Form;

use App\Entity\Utilisateur;
use App\Entity\Classe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
             ->add('nom', TextType::class, [
                 'attr' => [
                     'class' => 'mb-4 block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline',
                     'placeholder' => 'Dupont'
                 ],
                 'label' => 'Nom'
             ])
             ->add('prenom', TextType::class, [
                 'attr' => [
                     'class' => 'mb-4 block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline',
                     'placeholder' => 'Marcel'
                 ],
                 'label' => 'Prénom'
             ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'mb-4 block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline',
                    'placeholder' => 'example@example.fr'
                ],
                'label' => 'Adresse mail'
            ])
        ;
    }
    public function getDefaultOptions(array $options)
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
