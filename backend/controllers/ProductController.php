<?php

namespace backend\controllers;

use common\forms\ProductForm;
use common\forms\ProductSearchForm;
use common\services\ProductService;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

/**
 * Class ProductController
 * @package backend\controllers
 */
class ProductController extends BaseController
{

    /** @var ProductService */
    private $productService;

    /**
     * ProductController constructor.
     * @param $id
     * @param $module
     * @param ProductService $productService
     * @param array $config
     */
    public function __construct($id, $module, ProductService $productService, $config = [])
    {
        $this->productService = $productService;
        parent::__construct($id, $module, $config);
    }

    /**
     * @return string
     * @throws BadRequestHttpException
     */
    public function actionIndex()
    {
        $searchForm = new ProductSearchForm();
        if ($searchForm->load(\Yii::$app->request->get()) && !$searchForm->validate()) {
            throw new BadRequestHttpException("Validation error");
        }

        return $this->render('index', [
            'searchModel' => $searchForm,
            'dataProvider' => $this->productService->search($searchForm)
        ]);
    }

    /**
     * 1. Model VS AR
     * 2. UI validate
     * 3. Service data validated only
     *
     * @return string
     * @throws \common\exceptions\ValidationException
     */
    public function actionCreate()
    {
        $form = new ProductForm();

        if ($form->load(\Yii::$app->request->post()) && $form->validate()) {
            $this->productService->createByFrom($form);  // Service CALL
            \Yii::$app->session->setFlash("New product created");
            $this->redirect('index');
        }

        return $this->render('create', [
            'model' => $form
        ]);
    }

    /**
     * https://github.com/mark-gerarts/automapper-plus/tree/2.0
     *
     * 1. Manual mapping vs Factory vs Mapper
     * 2. Optional
     *
     * @param int $id
     * @return string
     * @throws \Exception
     */
    public function actionUpdate(int $id)
    {
        $product = $this->productService
            ->findOneById($id)
            ->orElseThrow(function () {
                return new NotFoundHttpException("Product not found");
            });

        /** @var ProductForm $form */
        $form = $this->mapper->map(ProductForm::class, $product);

        if ($form->load(\Yii::$app->request->post()) && $form->validate()) {
            $this->productService->createByFrom($form, $product); // Service CALL
            \Yii::$app->session->setFlash("Product updated");
            $this->redirect('index');
        }

        return $this->render('update', [
            'model' => $form
        ]);
    }
}
