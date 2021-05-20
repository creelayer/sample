<?php

namespace common\mappers;

use yii\base\BaseObject;
use yii\base\InvalidArgumentException;
use yii\base\Model;

/**
 * Class ModelMapper
 * @package common\models
 */
class ModelMapper extends BaseObject
{
    /**
     * @param $destination
     * @param $source
     * @return Model
     */
    public function map($destination, $source): Model
    {

        if (is_string($destination)) {
            $model = new $destination();
            if (!($model instanceof Model)) {
                throw new InvalidArgumentException('Destination class must be instance of Model.');
            }
        } elseif ($destination instanceof Model) {
            $model = $destination;
        } else {
            throw new \BadMethodCallException('Invalid destination type');
        }

        if ($source instanceof Model) {
            $data = $source->getAttributes();
        } elseif (is_array($source)) {
            $data = $source;
        } else {
            throw new \BadMethodCallException('Invalid source type');
        }

        foreach ($data as $attribute => $value) {
            $methodName = 'set' . ucfirst($attribute);
            if ($this->hasMethod($methodName)) {
                $this->$methodName($model, $attribute, $value);
            } elseif ($model->canSetProperty($attribute)) {
                $model->{$attribute} = $value;
            }
        }

        return $model;
    }
}