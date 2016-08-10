<?php

// src/AppBundle/Form/RegistrationType.php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')
                ->add('prenom')
                ->add('sexe', ChoiceType::class, array(
                    'choices' => array(
                        'Homme' => 'Homme',
                        'Femme' => 'Femme'
                    ),
                    'required'    => true,
                    'placeholder' => 'Votre sexe',
                    'empty_data'  => null
                ))
                ->add('adresse_postal', 'text', array(
                    'required' => false,
                ))
                ->add('code_postal', 'text', array(
                    'required' => false,
                ))
                ->add('ville', 'text', array(
                    'required' => false,
                ))
                ->add('date_naissance', DateType::class, array(
                    'widget' => 'single_text',
                    'attr' => ['class' => 'datepicker'],
                    'format' => 'dd-MM-yyyy'
                ))
                ->add('github', 'text', array(
                    'required' => false,
                ))
                ->add('languages')
        ;
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';

        // Or for Symfony < 2.8
        // return 'fos_user_registration';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}