<?php

namespace common\services;

use common\forms\OrderSearchForm;
use common\models\Customer;
use common\models\Order;
use ocramius\util\Optional;
use yii\data\ActiveDataProvider;

/**
 * Class OrderService
 * @package common\services
 */
class OrderService
{

    /** @var EntityManager  */
    private $entityManager;

    /**
     * OrderService constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Customer $customer
     * @return Optional
     */
    public function getLastOrderByCustomer(Customer $customer)
    {
        return Optional::ofNullable(Order::find()->lastCustomerOrder($customer)->one());
    }

    /**
     * @param Order $order
     * @throws \common\exceptions\ValidationException
     */
    public function confirmOrder(Order $order)
    {
        $order->setStatus(Order::STATUS_COMPLETE);
        $this->entityManager->save($order);
    }

    /**
     * @param OrderSearchForm $form
     * @return ActiveDataProvider
     */
    public function search(OrderSearchForm $form)
    {
        return new ActiveDataProvider([
            'query' => Order::find()->search($form),
        ]);
    }
}