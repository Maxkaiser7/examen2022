<?php

namespace App\Form;

use App\Entity\Chansons;
use App\Entity\Genres;
use Doctrine\DBAL\Types\IntegerType;
use Doctrine\DBAL\Types\StringType;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormTypeInterface;
class ChansonsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', \Symfony\Component\Form\Extension\Core\Type\TextType::class)
            ->add('artiste', \Symfony\Component\Form\Extension\Core\Type\TextType::class)
            ->add('album', \Symfony\Component\Form\Extension\Core\Type\TextType::class)
            ->add('paroles', \Symfony\Component\Form\Extension\Core\Type\TextType::class)
            ->add('genres', EntityType::class, [
                'class' =>  Genres::class,
                'multiple' => false,
                'expanded' => false,
                'choice_label' => 'titre'
            ])
            ->add('dateSortie', \Symfony\Component\Form\Extension\Core\Type\DateTimeType::class)
            ->add('Envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chansons::class,
        ]);
    }
}
