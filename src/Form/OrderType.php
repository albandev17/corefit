<?php

namespace App\Form;

use App\Entity\Adress;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $options['user'];
        $builder
        ->add('adresses', EntityType::class, [
            'label'     => false,
            'required'  => true,
            'class'     => Adress::class,
            'choices'   => $user->getAdresses(),
            'multiple'  => false,
            'expanded'  => true
        ])
        ->add('submit', SubmitType::class, [
            'label' => 'Valider ma commande',
            'attr'  =>  [
                'class' => "btn btn-small btn-block btn-success"
            ]
        ])
    ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'user' => []
        ]);
    }
}
