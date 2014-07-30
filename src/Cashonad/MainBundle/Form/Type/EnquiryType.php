<?php
namespace Cashonad\MainBundle\Form\Type;

use Cashonad\MainBundle\Entity\Enquiry;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\True;


/**
 * Enquiry Form Type
 *
 * @author supragya
 */
class EnquiryType extends AbstractType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver) 
	{
		$resolver->setDefaults(array(
			'data_class' => 'Cashonad\MainBundle\Entity\Enquiry'
			));
	}

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array('label' => ' Name:'))
            ->add('email', null, array('label' => 'Email:'))
            ->add('subject', null, array('label' => 'Subject:'))
            ->add('body', null, array('label' => 'Body:'))
            ->add('save', 'submit', array('label' => 'submit'))
        ;
    }
    
    public function getName() {
        return 'ontact';
    }

}
