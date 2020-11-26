<?php

namespace App\Form;

use App\Entity\Adress;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => "Nom",
                'attr'  => [
                    'placeholder'   => "Domicile"
                ]
            ])
            ->add('firstname', TextType::class, [
                'label' => "Votre prénom",
            ])
            ->add('lastname', TextType::class, [
                'label' => "Votre nom",
            ])
            ->add('adress',TextType::class, [
                'label' => "Votre adresse",
            ])
            ->add('postal',TextType::class, [
                'label' => "Votre code postal",
            ])
            ->add('city',TextType::class, [
                'label' => "Votre ville",
            ])
            ->add('country',CountryType::class, [
                'label' => "Pays",
            ])
            ->add('phone',TelType::class, [
                'label' => "Votre téléphone",
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adress::class,
        ]);
    }
}
