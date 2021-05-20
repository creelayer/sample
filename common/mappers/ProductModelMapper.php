<?php

namespace common\mappers;

use yii\base\Model;

/**
 * Class ProductModelMapper
 * @package common\mappers
 */
class ProductModelMapper extends ModelMapper
{

    /**
     * @param Model $destination
     * @param string $attribute
     * @param string $value
     */
    public function setName(Model $destination, string $attribute, string $value)
    {
        $destination->{$attribute} = trim($value);
    }


}