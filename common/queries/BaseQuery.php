<?php

namespace common\queries;

use yii\db\ActiveQuery;

/**
 * Class BaseQuery
 * @package common\queries
 */
abstract class BaseQuery extends ActiveQuery
{
    /**
     * @return $this
     */
    public function undeleted(): self
    {
        return $this->andWhere([
            'deleted_at' => null
        ]);
    }
}
