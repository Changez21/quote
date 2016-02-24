<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PreQuoteClient */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pre Quote Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pre-quote-client-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'qt_pre_quote_id',
            'software',
            'clientType',
            'canadaPrice',
            'quantity',
            'cost',
            'workflow',
            'formula',
            'labor',
            'locations',
            'notes:ntext',
            'learning',
            'usPrice',
        ],
    ]) ?>

</div>
