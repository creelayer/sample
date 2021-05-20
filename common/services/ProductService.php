<?php

namespace common\services;

use common\forms\ProductForm;
use common\forms\ProductSearchForm;
use common\mappers\ProductModelMapper;
use common\models\Product;
use ocramius\util\Optional;
use yii\data\ActiveDataProvider;

/**
 * Class ProductService
 * @package common\services
 */
class ProductService
{

    /** @var ProductModelMapper */
    private $productModelMapper;

    /** @var EntityManager */
    private $entityManager;

    /**
     * ProductService constructor.
     * @param ProductModelMapper $productModelMapper
     * @param EntityManager $entityManager
     */
    public function __construct(ProductModelMapper $productModelMapper, EntityManager $entityManager)
    {
        $this->productModelMapper = $productModelMapper;
        $this->entityManager = $entityManager;
    }

    /**
     * @param int $id
     * @return Optional|void
     */
    public function findOneById(int $id)
    {
        return Optional::ofNullable(Product::findOne($id));
    }

    /**
     * @param ProductForm $form
     * @param Product|null $product
     * @throws \common\exceptions\ValidationException
     */
    public function createByFrom(ProductForm $form, Product $product = null)
    {
        /** @var Product $product */
        $product = $this->productModelMapper->map($product ?? Product::class, $form);

        //some Logic

        $this->entityManager->save($product);
    }


    /**
     * @param ProductSearchForm $form
     * @return ActiveDataProvider
     */
    public function search(ProductSearchForm $form)
    {
        return new ActiveDataProvider([
            'query' => Product::find()->search($form)
        ]);
    }

}