<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PreQuoteClient */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pre-quote-client-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'qt_pre_quote_id')->textInput() ?>

    <?= $form->field($model, 'software')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'clientType')->dropDownList([ 'Input' => 'Input', 'Output' => 'Output', 'GUI' => 'GUI', 'Data' => 'Data', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'canadaPrice')->textInput() ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'cost')->textInput() ?>

    <?= $form->field($model, 'workflow')->textInput() ?>

    <?= $form->field($model, 'formula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'labor')->textInput() ?>

    <?= $form->field($model, 'locations')->textInput() ?>

    <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'learning')->textInput() ?>

    <?= $form->field($model, 'usPrice')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
