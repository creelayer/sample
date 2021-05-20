<?php

namespace backend\controllers;

use common\models\Customer;
use common\services\ProductService;
use common\services\PurchaseService;
use yii\web\NotFoundHttpException;

/**
 * Class PurchaseController
 * @package backend\controllers
 */
class PurchaseController extends BaseController
{

    /** @var PurchaseService */
    private $purchaseService;

    /** @var ProductService */
    private $productService;

    /**
     * OrderController constructor.
     * @param $id
     * @param $module
     * @param PurchaseService $purchaseService
     * @param ProductService $productService
     * @param array $config
     */
    public function __construct($id, $module, PurchaseService $purchaseService, ProductService $productService, $config = [])
    {
        $this->purchaseService = $purchaseService;
        $this->productService = $productService;
        parent::__construct($id, $module, $config);
    }

    /**
     * @param int $id
     * @throws \Exception
     */
    public function actionPurchase(int $id)
    {
        $customer = new Customer(); // current user

        $product = $this
            ->productService
            ->findOneById($id)
            ->orElseThrow(function () {
                return new NotFoundHttpException("Product not found");
            });

        $this->purchaseService->purchaseProduct($customer, $product);

        // return ;
    }

}
