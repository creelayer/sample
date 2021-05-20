<?php

use common\models\Product;
use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel \common\forms\ProductSearchForm */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pyramid Podcasts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pyramid-podcast-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'created_at',
            'updated_at',
            'deleted_at',
            [
                'label' => 'Purchase',
                'format' => 'html',
                'value' => function (Product $product) {
                    return Html::a("buy", ['/purchase', 'id' => $product->id]);
                }
            ]
        ],
    ]); ?>
</div>