<?php

namespace common\services\notification;

/**
 * Class NotificationService
 * @package common\services
 */
class NotificationService implements Notifier
{

    /** @var NotifierFactory  */
    private $notifierFactory;

    /**
     * NotificationService constructor.
     * @param NotifierFactory $notifierFactory
     */
    public function __construct(NotifierFactory $notifierFactory)
    {
        $this->notifierFactory = $notifierFactory;
    }

    /**
     * @param Message $message
     */
    public function notify(Message $message)
    {
        $this->notifierFactory->create($message)->notify($message);
    }
}