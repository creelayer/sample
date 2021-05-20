<?php

namespace common\forms;

use common\models\Product;
use yii\base\Model;

/**
 * Class ProductSearchForm
 * @package common\forms
 */
class ProductSearchForm extends Model
{

    /** @var string */
    public $name;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

}