<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

use app\models\Persons;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Persons';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="persons-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Tambah Personil', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Tambah Jenis Riwayat', ['createjenisriwayat'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_person',
            'nama',
            'nik',
            [
                'attribute' => 'jk',
                'filter' => ['1' => "Laki-Laki", '2' => "Perempuan"],
                'value' => function ($model, $key, $index) {
                    if ($model->jk == 1) {
                        return "Laki-Laki";
                    } else {
                        return "Perempuan";
                    }
                },
            ],
            'tgl_lahir',
            'tempat_lahir',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Persons $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_person' => $model->id_person]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>