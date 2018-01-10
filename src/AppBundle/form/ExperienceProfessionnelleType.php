<?php
/**
 * Created by PhpStorm.
 * User: clement
 * Date: 28/11/17
 * Time: 11:35
 */

namespace AppBundle\form;

use AppBundle\Entity\ExperienceProfessionnelle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExperienceProfessionnelleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('periode')
            ->add('organisme')
            ->add('poste')
            ->add('commentaire')
            ->add('Ajouter', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => ExperienceProfessionnelle::class
        ));
    }
}