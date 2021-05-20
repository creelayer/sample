<?php

namespace common\queries;

use common\forms\OrderSearchForm;
use common\models\Customer;
use common\models\Order;

/**
 * This is the ActiveQuery class for [[\common\models\Order]].
 *
 * @see \common\models\Order
 */
class OrderQuery extends BaseQuery
{

    /**
     * @param string|null $status
     * @return OrderQuery
     */
    public function status(string $status = null)
    {
        return $this->andFilterWhere(['status' => $status]);
    }

    /**
     * @param Customer $customer
     * @return OrderQuery
     */
    public function customer(Customer $customer)
    {
        return $this->andWhere(['customer_id' => $customer->id]);
    }

    /**
     * @param Customer $customer
     * @return OrderQuery
     */
    public function lastCustomerOrder(Customer $customer)
    {
        return $this->customer($customer)
            ->orderBy([
                'created_at' => SORT_DESC
            ]);
    }

    /**
     * @param OrderSearchForm $form
     * @return OrderQuery
     */
    public function search(OrderSearchForm $form)
    {
        $this
            ->undeleted()
            ->status($form->status)
            ->andFilterWhere(['>=', 'updated_at', $form->from])
            ->andFilterWhere(['<=', 'updated_at', $form->to]);

        if ($form->someSpecialParameter) {
            // $this->addSomeCondition...
        }

        return $this;
    }
}
