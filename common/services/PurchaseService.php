<?php

namespace common\services;

use common\models\Order;
use common\models\Product;
use common\models\Customer;
use common\services\notification\NotificationService;
use common\services\notification\NotifyMessage;
use common\util\OrderAmountCalculator;

/**
 * Class PurchaseService
 * @package common\services
 */
class PurchaseService
{

    /** @var OrderService */
    private $orderService;

    /** @var NotificationService */
    private $notificationService;

    /** @var OrderAmountCalculator */
    private $orderAmountCalculator;

    /** @var EntityManager */
    private $entityManager;

    /**
     * 1. Not only service
     *
     * PurchaseService constructor.
     * @param OrderService $orderService
     * @param NotificationService $notificationService
     * @param OrderAmountCalculator $orderAmountCalculator
     * @param EntityManager $entityManager
     */
    public function __construct(
        OrderService $orderService,
        NotificationService $notificationService,
        OrderAmountCalculator $orderAmountCalculator,
        EntityManager $entityManager
    )
    {
        $this->orderService = $orderService;
        $this->notificationService = $notificationService;
        $this->orderAmountCalculator = $orderAmountCalculator;
        $this->entityManager = $entityManager;
    }

    /**
     * @param Customer $customer
     * @param Product $product
     * @return Order
     * @throws \common\exceptions\ValidationException
     */
    public function purchaseProduct(Customer $customer, Product $product)
    {
        /** @var Order $order */
        $order = $this->orderService
            ->getLastOrderByCustomer($customer)
            ->filter(function (Order $order) {
                return $order->status == Order::STATUS_NEW;
            })
            ->orElse(Order::createByCustomer($customer));

        $order->addProduct($product);
        $order->setAmount($this->orderAmountCalculator->calculate($order));
        $this->entityManager->save($order);
        return $order;
    }

    /**
     * @param Order $order
     * @throws \common\exceptions\ValidationException
     */
    public function confirmPurchase(Order $order)
    {

        $this->orderService->confirmOrder($order);

        $this->notificationService->notify(new NotifyMessage());

        //add query
        //start shuttle
        //...
    }

}