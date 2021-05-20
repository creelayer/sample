<?php

namespace common\services\notification;

/**
 * Class NotifierFactory
 * @package common\services
 */
class NotifierFactory
{
    /**
     * @param Message $message
     * @return Notifier
     */
    public function create(Message $message): Notifier
    {
        return new EmailNotifier();
    }
}