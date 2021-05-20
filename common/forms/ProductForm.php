<?php

namespace common\forms;

use common\models\Product;
use yii\base\Model;

/**
 * Class ProductForm
 * @package common\forms
 */
class ProductForm extends Model
{

    /** @var string */
    public $name;

    /** @var int */
    public $price;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price'], 'required'],
            [['price'], 'default', 'value' => null],
            [['price'], 'integer', 'min' => 1],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @param Product $product
     * @return static
     */
    public static function createByProduct(Product $product)
    {
        $model = new static();
        $model->name = $product->name;
        $model->price = $product->price;

        return $model;
    }

}