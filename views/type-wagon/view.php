<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TypeWagon */

$this->title = $model->type;
$this->params['breadcrumbs'][] = ['label' => 'Типы вагонов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-wagon-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы точно хотите это удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'type',
            [
                'label' => 'Доступен',
                'value' => $model->enabled == 1 ? 'Да' : 'Нет',
            ],
        ],
    ]) ?>

</div>
