<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PromoGames */

$this->title = 'Create Promo Games';
$this->params['breadcrumbs'][] = ['label' => 'Promo Games', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promo-games-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
