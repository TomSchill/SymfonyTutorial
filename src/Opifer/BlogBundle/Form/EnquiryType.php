<?php

namespace Opifer\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class EnquiryType
 * This class is used to generate a new form.
 * @package Opifer\BlogBundle\Form
 */
class EnquiryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('email', 'email');
        $builder->add('subject');
        $builder->add('body', 'textarea');
    }

    public function getName() { return "contact"; }
} 