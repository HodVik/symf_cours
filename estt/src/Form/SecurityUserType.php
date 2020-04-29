<?php

namespace App\Form;

use App\Entity\SecurityUser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class SecurityUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array(
                'label' =>'Enter email: '
            ))
            ->add('password', RepeatedType::class, [
                'type'=> PasswordType::class,
                'first_options' => array('label'=>'Password: '),
                'second_options' => array('label'=>'Repeate password: ')
            ])
            ->add('submit', SubmitType::class, array(
                'label' => 'Sigin up'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SecurityUser::class,
        ]);
    }
}
