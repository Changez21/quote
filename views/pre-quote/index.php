<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PreQuoteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pre Quotes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pre-quote-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pre Quote', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'staffTraining',
            'goLive',
            'learning',
            'itTraining',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
