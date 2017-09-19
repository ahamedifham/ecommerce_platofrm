<?php
/**
 * Created by PhpStorm.
 * User: ifham
 * Date: 2/14/17
 * Time: 10:34 AM
 */

namespace AppBundle\Form\Type;

use AppBundle\Entity\Buyer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class BuyerType extends Base
{
    public function createForm(FormBuilderInterface $builder)
    {

        $builder->add('member',null,array('label'=>'Member Type'))
            ->add('firstName',null,array('label'=>'First Name'))
            ->add('surname',null,array('label'=>'Surname'))
            //->add('gender',null,array('label'=>'Gender'))

            ->add('gender', ChoiceType::class,array(
                'label'=>'Gender*',
                'expanded'=>true,
                'choices' => array('Male' => '1', 'Female' => '0'),
                'choices_as_values' => true,
            ))            ->add('dateOfBirth',null,array('label'=>'Date of Birth'))
            ->add('nationality',null,array('label'=>'Nationality'))
            ->add('email',null,array('label'=>'Email'))
            ->add('physicalAddress',null,array('label'=>'Physical Address'))
            ->add('BSBNumber',null,array('label'=>'BSB Number'))
            ->add('accountNumber',null,array('label'=>'Account Number'))
            ->add('accountName',null,array('label'=>'Account Name'))
            ->add('financialInstituteName',null,array('label'=>'Financial Institute Name'))
            ->add('save',SubmitType::class,array('label'=>'Register'))
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Buyer::class,
            'mode'=>null
        ));
    }
}