<?php

namespace App\Form;

use App\Entity\Body;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterBodyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'attr'  => [
                    'placeholder'   => 'Exemple : Actuellement / Objectif 1'
                ]
            ])
            ->add('taille', TextType::class, [
                'label' => 'Votre taille'
            ])
            ->add('poids', TextType::class, [
                'label' => 'Votre poids'
            ])
            ->add('bras', TextType::class, [
                'label' => 'Votre tour de bras'
            ])
            ->add('ventre', TextType::class, [
                'label' => 'Votre tour de ventre'
            ])
            ->add('cuisse', TextType::class, [
                'label' => 'Votre tour de cuisse'
            ])
            ->add('submit', SubmitType::class, [
                'label' => "Enregister"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Body::class,
        ]);
    }
}
