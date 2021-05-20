<?php

use yii\helpers\Html;

/**
 * @var \yii\web\View $this
 * @var \common\models\Order $model
 */

$this->title = 'Create product';

?>


<div class="support-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>

