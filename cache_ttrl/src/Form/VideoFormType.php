<?php

namespace App\Form;

use App\Entity\Video;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class VideoFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array(
                //'data' => 'Example title',
                'label' => 'Set video title: '
            ))
            ->add('category', TextType::class, array(
                //'data' => 'Example category',
                'label' => 'Set category: '
            ))
            // //it is dinamic parametr
            // ->add('created_at', DateType::class, array(
            //     'widget' => 'single_text',
            //     'label' => 'Set date: ',
            // ))
            ->add('save', SubmitType::class, array('label' => 'Add video'))
        ;
        
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event){
            $video = $event->getData();
            $form = $event->getForm();
            if(!$video||null === $video->getId()){
                $form->add('created_at', DateType::class, array(
                'widget' => 'single_text',
                'label' => 'Set date: '));
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Video::class,
        ]);
    }
}
