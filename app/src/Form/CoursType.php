<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\Cours;
use App\Entity\Formateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('description')
            ->add('duree')
            ->add('difficulte')
            ->add('objectif')
            ->add('categorie')
            ->add('id_classe', EntityType::class, [
                'class' => Classe::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('id_formateur', EntityType::class, [
                'class' => Formateur::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cours::class,
        ]);
    }
}
