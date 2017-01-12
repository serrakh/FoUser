<?php

namespace Rdv\FrontEndBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class OpticienType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->remove('username');
        $builder->add('responsable', ChoiceType::class, array(
            'choices'  => array(
                ''=>'',
                'Directeur de magasin' => "Directeur de magasin",
                'Propriétaire' => "Propriétaire",
            ),
        ));
        $builder->add('nom');
        $builder->add('prenom');

        $builder->add('civilisation', ChoiceType::class, array(
            'choices'  => array(
                ''=>'',
                'Homme' => "Homme",
                'Femme' => "Femme",
            ),
        ));
        $builder->add('email');
        $builder->add('telephone');
        $builder->add('nomMagasin');
        $builder->add('adresse');
        $builder->add('codePostal');
        $builder->add('ville');
        $builder->add('telMagasin');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Rdv\FrontEndBundle\Entity\Opticien'
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
        return '';
    }


}
