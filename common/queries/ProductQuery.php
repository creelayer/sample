<?php

namespace common\queries;

use common\forms\ProductSearchForm;

/**
 * This is the ActiveQuery class for [[\common\models\Product]].
 *
 * @see \common\models\Product
 */
class ProductQuery extends BaseQuery
{

    /**
     * @param ProductSearchForm $form
     * @return ProductQuery
     */
    public function search(ProductSearchForm $form)
    {
        return $this
            ->undeleted()
            ->andFilterWhere(['name' => $form->name]);
    }
}
