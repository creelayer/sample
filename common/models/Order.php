<?php

namespace common\models;

use common\queries\OrderProductQuery;
use common\queries\OrderQuery;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $status
 * @property int $amount
 *
 * @property OrderProduct[] $orderProducts
 * @property Product[] $products
 */
class Order extends ActiveRecord
{

    public const STATUS_NEW = 'new';
    public const STATUS_COMPLETE = 'complete';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['amount'], 'required'],
            [['amount'], 'integer'],
            [['status'], 'string', 'max' => 30],
            ['products', 'safe']
        ];
    }

    /**
     * @return array|array[]
     */
    public function behaviors()
    {
        return [
            'saveRelations' => [
                'class' => SaveRelationsBehavior::class,
                'relations' => [
                    'orderProducts'
                ],
            ],
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }

    /**
     * @param Customer $customer
     * @return Order
     */
    public static function createByCustomer(Customer $customer)
    {
        return new Order(['customer_id' => $customer->id]);
    }


    /**
     * @param int $amount
     */
    public function setAmount(int $amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return Customer
     */
    public function getCustomer()
    {
        return new Customer();
    }

    /**
     * Gets query for [[OrderItems]].
     *
     * @return ActiveQuery|OrderProductQuery
     */
    public function getOrderProducts()
    {
        return $this->hasMany(OrderProduct::class, ['order_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::class, ['id' => 'product_id'])->via('orderProducts');
    }

    /**
     * {@inheritdoc}
     * @return OrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderQuery(get_called_class());
    }


//=====================================================================//

    /**
     * @param string $status
     */
    public function setStatus(string $status)
    {
        if ($status == self::STATUS_COMPLETE && $this->status !== self::STATUS_NEW) {
            throw new \BadMethodCallException();
        }
        $this->status = $status;
    }

    /**
     * @param Product $product
     */
    public function addProduct(Product $product)
    {
        foreach ($this->orderProducts as $orderProduct) {

            if ($orderProduct->product_id == $product->id) {
                $orderProduct->count++;
                return;
            }
        }
        $orderProduct = OrderProduct::createByProduct($product);
        $this->orderProducts = array_merge($this->orderProducts, [$orderProduct]);
    }


}
