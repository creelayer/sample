<?php

namespace common\exceptions;

use Throwable;
use yii\base\Model;

/**
 * Class ValidationException
 * @package common\exceptions
 */
class ValidationException extends \Exception
{
    public function __construct(Model $model, $code = 0, Throwable $previous = null)
    {
        parent::__construct(current($model->getFirstErrors()), $code, $previous);
    }
}