<?php

namespace Hackzilla\Bundle\TicketBundle\Model;

interface TicketMessageInterface
{
    /**
     * Get id.
     *
     * @return int
     */
    public function getId();

    /**
     * Set status.
     *
     * @param int $status
     *
     * @return $this
     */
    public function setStatus($status);

    /**
     * Set status string.
     *
     * @param string $status
     *
     * @return $this
     */
    public function setStatusString($status);

    /**
     * Get status.
     *
     * @return int
     */
    public function getStatus();

    /**
     * Get status string.
     *
     * @return string
     */
    public function getStatusString();

    /**
     * Set priority.
     *
     * @param int $priority
     *
     * @return $this
     */
    public function setPriority($priority);

    /**
     * Set priority string.
     *
     * @param string $priority
     *
     * @return $this
     */
    public function setPriorityString($priority);

    /**
     * Get priority.
     *
     * @return int
     */
    public function getPriority();

    /**
     * Get priority string.
     *
     * @return string
     */
    public function getPriorityString();

    /**
     * Set user.
     *
     * @param int|UserInterface $user
     *
     * @return $this
     */
    public function setUser($user);

    /**
     * Get user.
     *
     * @return int
     */
    public function getUser();

    /**
     * Get user object.
     *
     * @return UserInterface
     */
    public function getUserObject();

    /**
     * Set message.
     *
     * @param string $message
     *
     * @return $this
     */
    public function setMessage($message);

    /**
     * Get message.
     *
     * @return string
     */
    public function getMessage();

    /**
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return $this
     */
    public function setCreatedAt(\DateTime $createdAt);

    /**
     * Get createdAt.
     *
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * Set ticket.
     *
     * @param TicketInterface $ticket
     *
     * @return $this
     */
    public function setTicket(TicketInterface $ticket = null);

    /**
     * Get ticket.
     *
     * @return TicketInterface
     */
    public function getTicket();

    /**
     * Returns an array of Statusescode -> Label
     * Enables users to Implement new statuses.
     *
     * @return array
     */
    public static function getStatuses();

    /*
     * Lets keep the statuses array for smother overriding in trait.
     */
    const STATUSES = array(
        TicketMessageInterface::STATUS_INVALID               => 'STATUS_INVALID',
        TicketMessageInterface::STATUS_OPEN                  => 'STATUS_OPEN',
        TicketMessageInterface::STATUS_IN_PROGRESS           => 'STATUS_IN_PROGRESS',
        TicketMessageInterface::STATUS_INFORMATION_REQUESTED => 'STATUS_INFORMATION_REQUESTED',
        TicketMessageInterface::STATUS_ON_HOLD               => 'STATUS_ON_HOLD',
        TicketMessageInterface::STATUS_RESOLVED              => 'STATUS_RESOLVED',
        TicketMessageInterface::STATUS_CLOSED                => 'STATUS_CLOSED',
    );

    const STATUS_INVALID               = 0;

    const STATUS_OPEN                  = 10;

    const STATUS_IN_PROGRESS           = 11;

    const STATUS_INFORMATION_REQUESTED = 12;

    const STATUS_ON_HOLD               = 13;

    const STATUS_RESOLVED              = 14;

    const STATUS_CLOSED                = 15;

    const PRIORITY_INVALID = 0;

    const PRIORITY_LOW     = 20;

    const PRIORITY_MEDIUM  = 21;

    const PRIORITY_HIGH    = 22;

    const PRIORITIES = [
        self::PRIORITY_INVALID => 'PRIORITY_INVALID',
        self::PRIORITY_LOW     => 'PRIORITY_LOW',
        self::PRIORITY_MEDIUM  => 'PRIORITY_MEDIUM',
        self::PRIORITY_HIGH    => 'PRIORITY_HIGH',
    ];
}
