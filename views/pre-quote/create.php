<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PreQuote */

$this->title = 'Create Pre Quote';
$this->params['breadcrumbs'][] = ['label' => 'Pre Quotes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pre-quote-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
