<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PreQuoteClientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pre Quote Clients';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pre-quote-client-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pre Quote Client', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'qt_pre_quote_id',
            'software',
            'clientType',
            'canadaPrice',
            // 'quantity',
            // 'cost',
            // 'workflow',
            // 'formula',
            // 'labor',
            // 'locations',
            // 'notes:ntext',
            // 'learning',
            // 'usPrice',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
