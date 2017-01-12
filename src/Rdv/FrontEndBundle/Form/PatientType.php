<?php

namespace Rdv\FrontEndBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PatientType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->remove('username');
        $builder->add('nom');
        $builder->add('prenom');
        $builder->add('dateNaissance','birthday', array(
            'format' => 'dd - MM - yyyy',
            'widget' => 'choice',
            'years' => range(date('Y'), date('Y')-70)
        ));
        $builder->add('civilisation', ChoiceType::class, array(
            'choices'  => array(
                ''=>'',
                'Homme' => "Homme",
                'Femme' => "Femme",
            ),
        ));
        $builder->add('telephone');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Rdv\FrontEndBundle\Entity\Patient'
        ));
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'rdv_frontendbundle_patient';
    }


}
