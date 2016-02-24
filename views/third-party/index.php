<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ThirdPartySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Third Parties';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="third-party-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Third Party', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'hardware',
            'canadaPrice',
            'usPrice',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
