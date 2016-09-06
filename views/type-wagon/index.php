<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\TypeWagonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Типы вагонов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-wagon-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php \yii\widgets\Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'type',
            [
                'attribute' => 'enabled',
                'value' => function($searchModel) {
                    return $searchModel->enabled == 1 ? 'Да': 'Нет';
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'enabled',
                    ['Нет', 'Да'],
                    ['class' => 'form-control',  'prompt'=>'Выберите...']
                )
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php \yii\widgets\Pjax::end(); ?>
</div>
