<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Game */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="game-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?php if($model->poster_image) {
        echo $model->poster_image;
    } ?>
    <?= $form->field($model, 'poster_image_file')->fileInput() ?>
    <?php if($model->gameplay_image) {
        echo $model->gameplay_image;
    } ?>
    <?= $form->field($model, 'gameplay_image_file')->fileInput() ?>
    <?php if($model->small_icon_image) {
        echo $model->small_icon_image;
    } ?>
    <?= $form->field($model, 'small_icon_file')->fileInput() ?>

    <?= $form->field($model, 'gameplay_image')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'video')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'developer')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'publisher')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'release_date')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'platform')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'short_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'rating')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
