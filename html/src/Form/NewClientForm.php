<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class which purpose is to submit a new client dataset.
 * User: bob
 * Date: 01/05/18
 * Time: 17:11
 * @see https://symfony.com/doc/current/form/form_collections.html
 * @see https://symfony.com/doc/current/form/embedded.html
 */
class NewClientForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class)
            ->add('person', PersonType::class)
            ->add('address', CollectionType::class, array(
                // looks for choices from this entity
                'entry_type' => AddressType::class,
                'entry_options' => array('label' => false),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false

                // uses the User.username property as the visible option string
                //'choice_label' => 'Address',

                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ))
            ->add('save', SubmitType::class, array('label' => 'Save me'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Client::class,
        ));
    }
}