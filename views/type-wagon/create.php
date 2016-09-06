<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TypeWagon */

$this->title = 'Создать тип вагона';
$this->params['breadcrumbs'][] = ['label' => 'Типы вагонов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-wagon-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
