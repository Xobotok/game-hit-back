<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Game */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Games', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="game-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title:ntext',
            'description:ntext',
            'big_icon_link:ntext',
            'small_icon_link:ntext',
            'video:ntext',
            'developer:ntext',
            'publisher:ntext',
            'release_date:ntext',
            'platform:ntext',
            'status',
            'category_id',
            'short_description:ntext',
            'dscription:ntext',
        ],
    ]) ?>

</div>