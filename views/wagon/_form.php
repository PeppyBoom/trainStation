<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Wagon */
/* @var $form yii\widgets\ActiveForm */
/* @var $typeItems array \app\models\TypeWagon */
/* @var $fileLoad */
?>

<div class="wagon-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'number_wagon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type_id')->dropDownList($typeItems, ['prompt' => 'Выберите...']) ?>

    <?= $form->field($fileLoad, 'imageFile')->fileInput()->label('Изображение вагона') ?>

    <?= Html::label("Загружена картинка: " . $model->img_path) ?>

    <?= $form->field($model, 'enabled')->dropDownList(['prompt' => 'Выберите...', '1' => 'Да', '0' => 'Нет']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
