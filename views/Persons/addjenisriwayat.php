<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Persons */

$this->title = 'Tambah Jenis Riwayat ';
$this->params['breadcrumbs'][] = ['label' => 'Persons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$data = $model->find()->all();
?>
<div class="persons-create">

    <?php

    foreach ($data as $cate_id => $item) {
        echo '<p>' . Html::a($item->nama_jenisriwayat) . " " ;
        echo Html::a('Delete', ['deljenis', 'id_jenis' => $item->id_jenisriwayat], [
            'class' => '',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]);
        echo '</p>';
    }
    ?>

    <?php $form = ActiveForm::begin(); ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_jhs', [
        'model' => $model,
    ]) ?>

    <?php ActiveForm::end(); ?>
</div>