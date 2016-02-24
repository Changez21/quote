<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Client */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="client-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'software')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'client_type')->dropDownList([ 'GUI' => 'GUI', 'Data' => 'Data', 'Input' => 'Input', 'Output' => 'Output', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'canada_price')->textInput() ?>

    <?= $form->field($model, 'us_price')->textInput() ?>

    <?= $form->field($model, 'configuration')->textInput() ?>

    <?= $form->field($model, 'learning')->textInput() ?>

    <?= $form->field($model, 'workflow')->textInput() ?>

    <?= $form->field($model, 'customization')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
