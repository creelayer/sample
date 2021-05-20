<?php

namespace backend\controllers;

use common\mappers\ModelMapper;
use yii\web\Controller;

/**
 * Class BaseController
 * @package backend\controllers
 *
 * @property ModelMapper $mapper
 */
class BaseController extends Controller
{

    /** @var string */
    protected $mapperClass = ModelMapper::class;

    /**
     * @return ModelMapper
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public function getMapper(): ModelMapper
    {
        return \Yii::$container->get($this->mapperClass);
    }
}
