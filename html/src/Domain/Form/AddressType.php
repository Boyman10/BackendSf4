<?php

namespace App\Domain\Form;


use App\Domain\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Address type used by New Client form.
 * User: bob
 * Date: 01/05/18
 * Time: 17:30
 */
class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('addressName', TextType::class)
                ->add('addressType', TextType::class)
                ->add('country',TextType::class)
                ->add('city', TextType::class)
                ->add('address', TextType::class)
                ->add('postcode', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Address::class,
        ));
    }

}