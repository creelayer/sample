<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var \yii\web\View $this
 * @var \common\models\Order $model
 */

    
?>

<div class="support-form">

    <?php $form = ActiveForm::begin(['method' => 'post']);?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]);?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]);?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']);?>
    </div>

    <?php ActiveForm::end();?>

</div>
