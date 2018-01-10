<?php
/**
 * Created by PhpStorm.
 * User: clement
 * Date: 04/12/17
 * Time: 16:27
 */

namespace Clement\BlogBundle\form;


use Clement\BlogBundle\Entity\Commentaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('contenu', TextareaType::class, ['label' => 'Commentaire'])
        ->add('Commenter', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Commentaire::class
        ));
    }

}