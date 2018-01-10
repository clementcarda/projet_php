<?php
/**
 * Created by PhpStorm.
 * User: clement
 * Date: 28/11/17
 * Time: 09:28
 */

namespace AppBundle\form;

use AppBundle\Entity\InfoCV;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InfoCVType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('adresse')
            ->add('codePostal')
            ->add('ville')
            ->add('telephone')
            ->add('mail')
            ->add('Ajouter', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => InfoCV::class
        ));
    }
}