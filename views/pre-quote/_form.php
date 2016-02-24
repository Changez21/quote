<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PreQuote */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pre-quote-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'staffTraining')->textInput() ?>

    <?= $form->field($model, 'goLive')->textInput() ?>

    <?= $form->field($model, 'learning')->textInput() ?>

    <?= $form->field($model, 'itTraining')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
