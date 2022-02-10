<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap4\Modal;
use app\models\InfoRiwayat;
use app\models\JenisRiwayat;

/* @var $this yii\web\View */
/* @var $model app\models\Persons */

$this->title = $model->id_person;
$this->params['breadcrumbs'][] = ['label' => 'Persons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

if ($role == 1) {
    $rr = 'Dosen';
} else if ($role == 2) {
    $rr = 'Mahasiswa';
} else if ($role == 3) {
    $rr = 'Pegawai';
} else {
    $rr = 'Tidak ada role';
}


\yii\web\YiiAsset::register($this);
?>
<div class="persons-view">

    <h1><?= Html::encode($model->nama) ?> [<?php echo $rr ?>]</h1>
    <p>
        <?= Html::a('Update', ['update', 'id_person' => $model->id_person], ['class' => 'btn btn-primary']) ?>
        
        <!-- <?= Html::a('Pilih Role', ['role', 'id_person' => $model->id_person], ['class' => 'btn btn-warning']) ?> -->
        <?= Html::button('Pilih Role', ['class' => 'btn btn-warning', 'onclick' => 'modalView();']); ?>
        <?php if ($rr != 'Tidak ada role') {
            echo Html::a('Tambah Riwayat', ['createriwayat', 'id_person' => $model->id_person, 'role' => $role], ['class' => 'btn btn-success']) ; echo "&nbsp;";
            echo Html::a('Ganti status menikah', ['menikah', 'id_person' => $model->id_person], [
                'class' => 'btn btn-warning',
                'data' => [
                    'confirm' => 'Apakah anda ingin mengganti status menikah ?',
                    'method' => 'post',
                ],
            ]);
        }  ?>
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
            ], [
                'attribute' => 'status_menikah',
                'value' => function ($model, $key) {
                    if ($model->statusMenikah($model->id_person) == 0) {
                        return "Belum Menikah";
                    } else {
                        return "Sudah Menikah";
                    }

                },
            ],[
                'attribute' => 'tanggal_menikah',
                'value' => function ($model, $key) {
                    return $model->tanggalMenikah($model->id_person);
                },
            ],
            'tgl_lahir',
            'tempat_lahir',
        ]
    ]) ?>

    <br>

    <?php

    $cate = JenisRiwayat::find()->all();

    foreach ($cate as $cate_id => $cater) {
        $items = InfoRiwayat::find()->orderBy('tgl_riwayat ASC')->where(['id_person' => $model->id_person,'jenis_role' => $role, 'id_jenisriwayat' => $cater->id_jenisriwayat])->all();
        echo '<h4>' . $cater->nama_jenisriwayat . '</h4>';
        echo '<hr>';
        foreach ($items as $itemf => $item) {
            echo '<p>' . Html::a($item->riwayat) . ' (' . $item->tgl_riwayat . ')  '.   Html::a('Delete', ['delriwayat', 'id_riwayat' => $item->id_riwayat], [
                'class' => '',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this history record?',
                    'method' => 'post',
                ],
            ]) .'</p>';
        }
    }

    ?>

    <?php
    echo Html::beginForm(['role', 'id_person' => $model->id_person], 'POST');
    Modal::begin([
        'title' => '<h2>Pilih Role</h2>',
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
    echo Html::hiddenInput('id_person', $model->id_person);
    echo "<div id='modalContent'><div class='form-group' style='text-align:center'>"
        . Html::dropDownList(
            "role",
            "role",
            [1 => "Dosen", 2 => "Mahasiswa", 3 => "Pegawai"],
            ['name' => 'role', 'class' => 'custom-select'],
        )
        . "</div>";
    echo "<div class='form-group'>";
    echo Html::submitButton('Simpan', ['class' => 'btn btn-primary']);
    echo "</div></div>";
    Modal::end();
    echo Html::endForm();

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