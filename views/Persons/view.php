<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap4\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\Persons */

$this->title = $model->id_person;
$this->params['breadcrumbs'][] = ['label' => 'Persons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="persons-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Update', ['update', 'id_person' => $model->id_person], ['class' => 'btn btn-primary']) ?>
        <!-- <?= Html::a('Pilih Role', ['role', 'id_person' => $model->id_person], ['class' => 'btn btn-warning']) ?> -->
        <?= Html::button('Pilih Role', ['class' => 'btn btn-warning', 'onclick' => 'modalView();']); ?>
        <?= Html::a('Delete', ['delete', 'id_person' => $model->id_person], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_person',
            'nama',
            'nik',
            [
                'attribute' => 'jk',
                'value' => (($model->jk == 1) ? "Laki-Laki" : 'Perempuan')
            ],
            'tgl_lahir',
            'tempat_lahir',
        ]
    ]) ?>

    <?php

    Modal::begin([
        'headerOptions' => ['id' => 'modalHeader'],
        'id' => 'modal',
        'size' => 'modal-lg',
        'closeButton' => [
            'id' => 'close-button',
            'class' => 'close',
            'data-dismiss' => 'modal',
        ],
        //keeps from closing modal with esc key or by clicking out of the modal.
        // user must click cancel or X to close
        'clientOptions' => ['backdrop' => false, 'keyboard' => true]
    ]);
    echo "<div id='modalContent'><div style='text-align:center'>"
        . Html::dropDownList("Pilih Role",[1 => "Dosen", 2 => "Mahasiswa", 3 => "Pegawai"] ,  ['prompt' => ''])
        . "</div></div>";
    Modal::end();

    ?>

    <script>
        function modalView() {
            if ($('#modal').hasClass('in')) {
                $('#modal').find('#modalContent')
                    .load($(this).attr('value'));
                document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
            } else {
                $('#modal').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'));
                document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
            }
        }
    </script>

</div>