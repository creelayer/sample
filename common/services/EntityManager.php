<?php

namespace common\services;

use common\exceptions\ValidationException;
use yii\db\ActiveRecord;

/**
 * Class EntityManager
 * @package common\services
 */
class EntityManager implements Persistent
{
    /**
     * @param ActiveRecord $model
     * @throws ValidationException
     */
    public function save(ActiveRecord $model)
    {
        if (!$model->save()) {
            throw new ValidationException($model);
        }
    }
}