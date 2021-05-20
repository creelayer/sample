<?php

namespace common\services\notification;

/**
 * Interface Notifier
 * @package common\services
 */
interface Notifier
{
    public function notify(Message $message);
}