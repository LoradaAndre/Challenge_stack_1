<?php

namespace App\Form;

use App\Entity\Organisme;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class OrganismeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => [
                    'class' => 'mb-4 block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline',
                    'placeholder' => 'ESGI Lyon'
                ],
                'label' => 'Nom de l\'organisme'
            ])
            ->add('adresse', TextType::class, [
                'attr' => [
                    'class' => 'mb-4 block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline',
                    'placeholder' => 'Adresse'
                ],
                'label' => 'Nom de l\'organisme'
            ])
            ->add('ville', TextType::class, [
                'attr' => [
                    'class' => 'mb-4 block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline',
                    'placeholder' => 'Lyon'
                ],
                'label' => 'Ville'
            ])
            ->add('Ajouter', SubmitType::class, [
                'attr' => ['class' => 'bg-orange-500 text-white p-2 rounded-md w-full']
            ]);
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Organisme::class,
        ]);
    }
}
