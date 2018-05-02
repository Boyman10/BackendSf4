<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Person;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class which purpose is to submit a new client dataset.
 * User: bob
 * Date: 01/05/18
 * Time: 17:11
 * @see https://symfony.com/doc/current/form/form_collections.html
 */
class NewClientForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class)
            ->add('person', EntityType::class, array(
                'class' => Person::class

                )
            )
            ->add('address', CollectionType::class, array(
                // looks for choices from this entity
                'entry_type' => AddressType::class,
                'entry_options' => array('label' => false),
                'allow_add' => true,

                // uses the User.username property as the visible option string
                //'choice_label' => 'Address',

                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Client::class,
        ));
    }
}