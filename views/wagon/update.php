<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Wagon */
/* @var $typeItems \app\models\TypeWagon*/

$this->title = 'Обновить вагон: ' . $model->number_wagon;
$this->params['breadcrumbs'][] = ['label' => 'Вагоны', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Вагон № ' . $model->number_wagon, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновление';
?>
<div class="wagon-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'typeItems' => $typeItems,
        'fileLoad' => $fileLoad,
    ]) ?>

</div>
