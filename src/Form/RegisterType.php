<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('firstname', TextType::class, [
            'label'         => 'Prénom', 
            'constraints'    =>  new Length([
                'min' => 2,
                'max' => 30,
            ]),
            'attr'          => [
                'placeholder' => 'John'
            ]
        ])
        ->add('lastname', TextType::class, [
            'label' => 'Nom',
            'constraints'    =>  new Length([
                'min' => 2,
                'max' => 30,
            ]),
            'attr'  => [
                'placeholder' => 'Doe'
            ]
        ])
        ->add('email', EmailType::class, [
            'label' => 'E-mail',
            'constraints'    =>  new Length([
                'min' => 2,
                'max' => 60,
            ]),
            'attr'  => [
                'placeholder' => 'johndoe@gmail.com'
            ]
        ])
        ->add('password', RepeatedType::class, [
            'type'              => PasswordType::class,
            'invalid_message'   => 'Le mot de passe et la confirmation doivent être identique',
            'label'             => 'Mot de passe',
            'required'          => true,
            'first_options'     => ['label' => 'Mot de passe'],
            'second_options'    => ['label' => 'Confirmez votre mot de passe']
        ])
        ->add('submit', SubmitType::class, [
            'label' => "S'inscrire"
        ])
    ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
