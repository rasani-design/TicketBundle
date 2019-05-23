<?php


namespace Hackzilla\Bundle\TicketBundle\TwigExtension;


use Hackzilla\Bundle\TicketBundle\Entity\TicketMessage;
use Hackzilla\Bundle\TicketBundle\Model\TicketMessageInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TicketStatusExtension extends AbstractExtension
{
    protected $statuses;

    protected $ticketMessageClass;

    /**
     * TicketStatusExtension constructor.
     * @param $ticketMessageClass
     */
    public function __construct($ticketMessageClass)
    {
        $this->ticketMessageClass = $ticketMessageClass;
        //TODO Maybe an error is of use if classname is no intance of TicketMessage Interface
        $this->statuses = $ticketMessageClass::getStatuses();
    }

    public function getFunctions()
    {
        return array(
            new TwigFunction(
                'hackzilla_getTicketStatusStringById',
                array($this,'getTicketStatusStringById'),
                array('is_safe' => array('html'))
            ),
            new TwigFunction(
                'hackzilla_getTicketStatusStringByMessage',
                array($this,'getTicketStatusStringMessage'),
                array('is_safe' => array('html'))
            ),
        );
    }

    private function getTicketStatusStringById($statusId)
    {
        if(array_key_exists($stausId, $this->statuses)) {
            return $this->statuses[$statusId];
        }

        return $this->statuses[TicketMessageInterface::STATUS_INVALID];
    }

    /**
     * @param TicketMessageInterface $ticketMessage
     * @return mixed
     */
    private function getTicketStatusStringMessage($ticketMessage) {

        if($ticketMessage instanceof $this->ticketMessageClass) {
            return $this->statuses[$ticketMessage->getStatus()];
        }

        return $this->statuses[TicketMessageInterface::STATUS_INVALID];
    }
}