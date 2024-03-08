<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\Cours;
use App\Entity\Formateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class CoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'attr'=> ['class'=>'bg-red-700 flex mt-2 white'],
                'label_attr' => ['class' => 'text-lg font-bold text-blue-500']
            ])
            ->add('description')
            ->add('duree')
            ->add('difficulte', IntegerType::class, [
                'attr'=> ['max'=>5]
            ])
            ->add('objectif')
            ->add('categorie', ChoiceType::class, [
                'choices' => [
                    'Catégorie 1' => 'categorie1',
                    'Catégorie 2' => 'categorie2',
                    'Catégorie 3' => 'categorie3',
                ],
                'placeholder' => '--Sélectionnez une catégorie--',
                'attr' => ['class' => 'block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline'],
            ])
            ->add('id_formateur', EntityType::class, [
                'class' => Formateur::class,
                'choice_label' => 'id',
            ])
            ->add('Ajouter', SubmitType::class)


        
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cours::class,
        ]);
    }
}
