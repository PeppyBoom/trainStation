<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\WagonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Вагоны';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wagon-index">

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

            'number_wagon',
            [
                'attribute' => 'type_id',
                'value' => function($searchModel) {
                    return $searchModel->typeWagon->type;
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'type_id',
                    ArrayHelper::map(\app\models\TypeWagon::find()->where(['enabled' => 1, 'deleted' => 0])->all(), 'id', 'type'),
                    ['class' => 'form-control',  'prompt'=>'Выберите...']
                )
            ],
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
            'created_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php \yii\widgets\Pjax::end(); ?>
</div>
