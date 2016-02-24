<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PreQuoteClient */

$this->title = 'Update Pre Quote Client: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pre Quote Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pre-quote-client-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
