<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Sylius\Bundle\TaxationBundle\Form\Type;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * @author Julien Janvier <j.janvier@gmail.com>
 */
class TaxCategoryTypeSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('TaxCategory', array('sylius'));
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\TaxationBundle\Form\Type\TaxCategoryType');
    }

    function it_is_a_form_type()
    {
        $this->shouldImplement('Symfony\Component\Form\FormTypeInterface');
    }

    function it_has_a_valid_name()
    {
        $this->getName()->shouldReturn('sylius_tax_category');
    }

    function it_builds_form_with_proper_fields(FormBuilder $builder)
    {
        $builder
            ->add('name', 'text', Argument::any())
            ->willReturn($builder)
        ;

        $builder
            ->add('description', 'textarea', Argument::any())
            ->willReturn($builder)
        ;

        $this->buildForm($builder, array());
    }

    function it_defines_assigned_data_class(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(
                array(
                    'data_class'        => 'TaxCategory',
                    'validation_groups' => array('sylius'),
                )
            )
            ->shouldBeCalled();

        $this->setDefaultOptions($resolver);
    }
}
