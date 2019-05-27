<?php


namespace Hackzilla\Bundle\TicketBundle\TwigExtension;


use Hackzilla\Bundle\TicketBundle\Entity\TicketMessage;
use Hackzilla\Bundle\TicketBundle\Model\TicketInterface;
use Hackzilla\Bundle\TicketBundle\Model\TicketMessageInterface;
use http\Exception\UnexpectedValueException;
use Symfony\Component\HttpFoundation\Response;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
                'hackzilla_getMessageStatusString',
                array($this,'getMessageStatusString'),
                array('is_safe' => array('html'))
            ),
            new TwigFunction(
                'hackzilla_getTicketStatusString',
                array($this,'getTicketStatusString'),
                array('is_safe' => array('html'))
            ),
            new TwigFunction(
                'hackzilla_hasStatusByStatusString',
                array($this,'hasStatusByStatusString'),
                array('is_safe' => array('html'))
            )
        );
    }

    public function getTicketStatusStringById($statusId)
    {
        if(array_key_exists($statusId, $this->statuses)) {
            return $this->statuses[$statusId];
        }

        return $this->statuses[TicketMessageInterface::STATUS_INVALID];
    }

    /**
     * @param TicketMessageInterface $ticketMessage
     * @return mixed
     */
    public function getMessageStatusString($ticketMessage)
    {

        if($ticketMessage instanceof $this->ticketMessageClass) {
            return $this->statuses[$ticketMessage->getStatus()];
        }

        return $this->statuses[TicketMessageInterface::STATUS_INVALID];
    }

    public function getTicketStatusString(TicketInterface $ticket)
    {
        if($ticket instanceof TicketInterface) {
            return $this->statuses[$ticket->getStatus()];
        }

        return $this->statuses[TicketMessageInterface::STATUS_INVALID];
    }

    /**
     * @param TicketInterface|TicketMessageInterface $entity
     * @param string $statusstring
     */
    public function hasStatusByStatusString($entity, $statusString)
    {
        if(!($entity instanceof TicketMessageInterface || $entity instanceof TicketInterface)) {
            throw new HttpException(422);
        }

        return $statusString == $this->statuses[$entity->getStatus()];

    }
}