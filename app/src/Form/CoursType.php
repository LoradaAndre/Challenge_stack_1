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
            ->add('categorie')
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
