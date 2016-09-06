<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TypeWagon */

$this->title = 'Обновить тип вагона: ' . $model->type;
$this->params['breadcrumbs'][] = ['label' => 'Типы вагонов', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->type, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновление';
?>
<div class="type-wagon-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
