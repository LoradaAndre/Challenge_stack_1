<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\Cours;
use App\Entity\Formation;
use App\Entity\Organisme;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClasseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'attr' => [
                    'class' => 'mb-4 block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline',
                    'placeholder' => 'IW2'
                ],
                'label' => 'Nom de la classe'
                ])
            ->add('id_organisme', EntityType::class, [
                'class' => Organisme::class,
                'choice_label' => 'nom',
                'label' => 'Organisme de formation',
                'placeholder' => '-- Sélectionnez un organisme --',
                'attr' => ['class' => 'mb-4 block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline'],
            ])
            ->add('id_formation', EntityType::class, [
                'class' => Formation::class,
                'choice_label' => 'intitule',
                'label' => 'Formation',
                 'placeholder' => '-- Sélectionnez une formation --',
                'attr' => ['class' => 'mb-8 block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline'],

            ])
            ->add('Ajouter', SubmitType::class, [
                'attr' => ['class' => 'bg-orange-500 text-white p-2 rounded-md w-full']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Classe::class,
        ]);
    }
}
