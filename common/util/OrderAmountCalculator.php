<?php

namespace common\util;

use common\models\Order;

/**
 * Class OrderAmountCalculator
 * @package common\services
 */
class OrderAmountCalculator
{
    /**
     * @param Order $order
     * @return int
     */
    public function calculate(Order $order){
        return 9999;
    }
}