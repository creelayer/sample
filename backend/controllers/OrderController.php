<?php

namespace backend\controllers;

use common\forms\OrderSearchForm;
use common\services\OrderService;

/**
 * Class OrderController
 * @package backend\controllers
 */
class OrderController extends BaseController
{

    /** @var OrderService */
    private $orderService;

    /**
     * OrderController constructor.
     * @param $id
     * @param $module
     * @param OrderService $orderService
     * @param array $config
     */
    public function __construct($id, $module, OrderService $orderService, $config = [])
    {
        $this->orderService = $orderService;
        parent::__construct($id, $module, $config);
    }

    /**
     * 1. ActiveQuery
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchForm = new OrderSearchForm();
        $searchForm->load(\Yii::$app->request->get());
        $dataProvider = $this->orderService->search($searchForm->validate() ? $searchForm : new OrderSearchForm());

        return $this->render('index', [
            'searchForm' => $searchForm,
            'dataProvider' => $dataProvider
        ]);
    }

}
