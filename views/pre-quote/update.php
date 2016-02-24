<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PreQuote */

$this->title = 'Update Pre Quote: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pre Quotes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pre-quote-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
