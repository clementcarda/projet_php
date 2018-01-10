<?php
/**
 * Created by PhpStorm.
 * User: clement
 * Date: 28/11/17
 * Time: 12:18
 */

namespace AppBundle\form;

use AppBundle\Entity\Competence;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompetenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('niveau')
            ->add('commentaire')
            ->add('Ajouter', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Competence::class
        ));
    }
}