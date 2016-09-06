<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Wagon */

$this->title = 'Вагон № ' . $model->number_wagon;
$this->params['breadcrumbs'][] = ['label' => 'Вагоны', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wagon-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы точно хотите удалить это?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'number_wagon',
            [
                'label' => 'Род вагона',
                'value' => $model->typeWagon->type,
            ],
            'created_at',
            [
                'label' => 'Доступен',
                'value' => $model->enabled == 1 ? 'Да' : 'Нет',
            ],
        ],
    ]) ?>
    <?php if (!empty($model->img_path)):?><img src="/<?= $model->img_path?>"><?php endif;?>
</div>
