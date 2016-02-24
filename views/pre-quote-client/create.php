<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PreQuoteClient */

$this->title = 'Create Pre Quote Client';
$this->params['breadcrumbs'][] = ['label' => 'Pre Quote Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pre-quote-client-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
