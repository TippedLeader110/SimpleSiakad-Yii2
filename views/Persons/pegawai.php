<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

use app\models\Pegawai;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pegawai';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="persons-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- <p>
        <?= Html::a('Create Persons', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id_person',
                'contentOptions' => ['styles' => 'width:20px']
            ],
            [
                'attribute' => 'nama',
                'value' => function($model, $key, $index){
                    return $model->persons->nama;
                }
            ],'persons.nik',
            'persons.tgl_lahir',
            'persons.tempat_lahir',
            //'tempat_lahir',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Pegawai $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_person' => $model->id_person]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
