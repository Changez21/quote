<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ThirdParty */

$this->title = 'Create Third Party';
$this->params['breadcrumbs'][] = ['label' => 'Third Parties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="third-party-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
