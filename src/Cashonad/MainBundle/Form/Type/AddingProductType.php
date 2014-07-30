<?php

namespace COA\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\True;

/**
 * Advertiser adding product Form Type
 *
 * @author supragya
 */
class addProductType extends AbstractType {

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Cashonad\AdminBundle\Entity\Product'
        ));
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('productName', null, array('label' => 'Product Name'))
                ->add('productType', null, array('label' => 'Product Type'))
        ;
    }

    public function getName() {
        return 'adding_product';
    }

}
