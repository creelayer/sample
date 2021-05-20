<?php

namespace common\forms;

use common\models\Order;
use yii\base\Model;

/**
 * Class OrderSearchForm
 * @package common\forms
 */
class OrderSearchForm extends Model
{

    /** @var string */
    public $from;

    /** @var int */
    public $to;

    /** @var string */
    public $status;

    /** @var string */
    public $someSpecialParameter;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['from', 'to'], 'date'],
            ['status', 'in', 'range' => [Order::STATUS_NEW, Order::STATUS_COMPLETE]]
        ];
    }

}