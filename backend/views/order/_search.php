<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;


/**
 * @var $searchForm \common\forms\OrderSearchForm
 */


?>

<?php
$form = ActiveForm::begin([
    'id' => 'login-form',
    'method' => 'get',
]) ?>

<div class="row">
    <div class="col-md-3"><?= $form->field($searchForm, 'from') ?></div>
    <div class="col-md-3"><?= $form->field($searchForm, 'to') ?></div>
</div>
<div class="form-group"><?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?></div>

<?php ActiveForm::end() ?>
