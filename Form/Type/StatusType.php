<?php

namespace Hackzilla\Bundle\TicketBundle\Form\Type;

use Hackzilla\Bundle\TicketBundle\Entity\TicketMessage;
use Hackzilla\Bundle\TicketBundle\Model\TicketMessageInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StatusType extends AbstractType
{
    protected $ticketMessageClass;

    public function __construct($ticketMessageClass)
    {
        $this->ticketMessageClass = $ticketMessageClass;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $choices = $this->ticketMessageClass::getStatuses();
        unset($choices[0]);

        $resolver->setDefaults(
            [
                'choices_as_values' => true,
                'choices'           => array_flip($choices),
            ]
        );
    }

    public function getParent()
    {
        return ChoiceType::class;
    }

    public function getBlockPrefix()
    {
        return 'status';
    }
}
