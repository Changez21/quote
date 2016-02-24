<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PreQuoteClientSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pre-quote-client-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'qt_pre_quote_id') ?>

    <?= $form->field($model, 'software') ?>

    <?= $form->field($model, 'clientType') ?>

    <?= $form->field($model, 'canadaPrice') ?>

    <?php // echo $form->field($model, 'quantity') ?>

    <?php // echo $form->field($model, 'cost') ?>

    <?php // echo $form->field($model, 'workflow') ?>

    <?php // echo $form->field($model, 'formula') ?>

    <?php // echo $form->field($model, 'labor') ?>

    <?php // echo $form->field($model, 'locations') ?>

    <?php // echo $form->field($model, 'notes') ?>

    <?php // echo $form->field($model, 'learning') ?>

    <?php // echo $form->field($model, 'usPrice') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
