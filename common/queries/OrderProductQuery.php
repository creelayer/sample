<?php

namespace common\queries;

use common\models\OrderProduct;

/**
 * This is the ActiveQuery class for [[\common\models\OrderItem]].
 *
 * @see \common\models\OrderProduct
 */
class OrderProductQuery extends BaseQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return OrderProduct[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return OrderProduct|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
