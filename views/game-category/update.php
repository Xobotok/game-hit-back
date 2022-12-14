<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GameCategory */

$this->title = 'Update Game Category: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Game Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="game-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
