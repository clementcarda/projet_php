<?php
/**
 * Created by PhpStorm.
 * User: clement
 * Date: 28/11/17
 * Time: 10:44
 */

namespace AppBundle\form;

use AppBundle\Entity\Formation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('duree')
            ->add('commentaire', TextareaType::class)
            ->add('Ajouter', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Formation::class
        ));
    }
}