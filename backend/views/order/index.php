<?php

use common\models\Product;
use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchForm \common\forms\OrderSearchForm */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pyramid-podcast-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['searchForm' => $searchForm]); ?>


    <?php if($dataProvider):?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'status',
            'created_at',
            'updated_at',
            'deleted_at'
        ],
    ]); ?>
    <?endif;?>
</div>