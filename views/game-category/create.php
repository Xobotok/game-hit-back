<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GameCategory */

$this->title = 'Create Game Category';
$this->params['breadcrumbs'][] = ['label' => 'Game Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="game-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
