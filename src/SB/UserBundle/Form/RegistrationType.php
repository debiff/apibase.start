<?php
/**
 * Created by PhpStorm.
 * User: simone
 * Date: 22/03/16
 * Time: 18.56
 */
namespace SB\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getName()
    {
        return 'registration';
    }
}