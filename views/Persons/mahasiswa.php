<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

use app\models\Mahasiswa;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mahasiswa';
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
            ],[
                'attribute' => 'persons.nik',
                'value' => function($model, $key, $index){
                    return $model->persons->nik;
                }
            ],[
                'attribute' => 'persons.tgl_lahir',
                'value' => function($model, $key, $index){
                    return $model->persons->tgl_lahir;
                }
            ],[
                'attribute' => 'persons.tempat_lahir',
                'value' => function($model, $key, $index){
                    return $model->persons->tempat_lahir;
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Mahasiswa $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_person' => $model->id_person]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
