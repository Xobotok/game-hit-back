<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PromoGames */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="promo-games-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'game_id')->textInput() ?>

    <?= $form->field($model, 'number')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
