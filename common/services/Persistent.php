<?php

namespace common\services;

use yii\db\ActiveRecord;

/**
 * Interface Persistent
 * @package common\services
 */
interface Persistent
{
    public function save(ActiveRecord $model);
}