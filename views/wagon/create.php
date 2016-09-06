<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Wagon */
/* @var $typeItems \app\models\TypeWagon*/

$this->title = 'Создание вагона';
$this->params['breadcrumbs'][] = ['label' => 'Вагоны', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wagon-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'typeItems' => $typeItems,
        'fileLoad' => $fileLoad,
    ]) ?>

</div>
