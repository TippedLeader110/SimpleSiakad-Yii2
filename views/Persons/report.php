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
$this->params['breadcrumbs'][] = ['label' => 'Info Detail', 'url' => ['view', "id_person" => $model->id_person]];
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
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id_person',
                'nama',
                'nik',
                [
                    'attribute' => 'role',
                    'value' => function ($model, $key) {
                        if ($model->role == 1) {
                            return "Dosen";
                        } else if ($model->role == 2) {
                            return "Mahasiswa";
                        } else if ($model->role == 3) {
                            return "Pegawai";
                        } else {
                            return "Tidak ada role";
                        }
                    }
                ],
                [
                    'attribute' => 'jk',
                    'value' => (($model->jk == 1) ? "Laki-Laki" : 'Perempuan')
                ],
                'tgl_lahir',
                'tempat_lahir',
            ]
        ]) ?>
        <br>
        <br>
    <h4>Riwayat Menikah</h4>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'dosen.status_menikah',
                'label' => 'Status menikah saat menjadi dosen',
                'value' => function ($model, $key) {
                    if ($model->dosen->status_menikah == 0) {
                        return "Belum Menikah";
                    } else {
                        return "Sudah Menikah";
                    }
                },
            ], [
                'attribute' => 'dosen.tanggal_menikah',
                'value' => function ($model, $key) {
                    return $model->dosen->tanggal_menikah;
                },
            ], [
                'attribute' => 'mahasiswa.status_menikah',
                'label' => 'Status menikah saat menjadi mahasiswa',
                'value' => function ($model, $key) {
                    if ($model->mahasiswa->status_menikah == 0) {
                        return "Belum Menikah";
                    } else {
                        return "Sudah Menikah";
                    }
                },
            ], [
                'attribute' => 'mahasiswa.tanggal_menikah',
                'value' => function ($model, $key) {
                    return $model->mahasiswa->tanggal_menikah;
                },
            ], [
                'attribute' => 'pegawai.status_menikah',
                'label' => 'Status menikah saat menjadi pegawai',
                'value' => function ($model, $key) {
                    if ($model->pegawai->status_menikah == 0) {
                        return "Belum Menikah";
                    } else {
                        return "Sudah Menikah";
                    }
                },
            ], [
                'attribute' => 'pegawai.tanggal_menikah',
                'value' => function ($model, $key) {
                    return $model->pegawai->tanggal_menikah;
                },
            ],
        ]
    ]) ?>

    <?php

    echo "<br><br><h4>Riwayat Dosen</h4>";

    $cate = JenisRiwayat::find()->all();

    foreach ($cate as $cate_id => $cater) {
        $items = InfoRiwayat::find()->orderBy('tgl_riwayat ASC')->where(['id_person' => $model->id_person, 'jenis_role' => 1, 'id_jenisriwayat' => $cater->id_jenisriwayat])->all();
        echo '<h5>' . $cater->nama_jenisriwayat . '</h5>';
        echo '<hr>';
        foreach ($items as $itemf => $item) {
            echo '<p>' . Html::a($item->riwayat) . ' (' . $item->tgl_riwayat . ') </p>';
        }
    }

    echo "<br><br><h4>Riwayat Mahasiswa</h4>";
    $cate = JenisRiwayat::find()->all();

    foreach ($cate as $cate_id => $cater) {
        $items = InfoRiwayat::find()->orderBy('tgl_riwayat ASC')->where(['id_person' => $model->id_person, 'jenis_role' => 2, 'id_jenisriwayat' => $cater->id_jenisriwayat])->all();
        echo '<h5>' . $cater->nama_jenisriwayat . '</h5>';
        echo '<hr>';
        foreach ($items as $itemf => $item) {
            echo '<p>' . Html::a($item->riwayat) . ' (' . $item->tgl_riwayat . ') </p>';
        }
    }

    echo "<br><br><h4>Riwayat Pegawai</h4>";
    $cate = JenisRiwayat::find()->all();

    foreach ($cate as $cate_id => $cater) {
        $items = InfoRiwayat::find()->orderBy('tgl_riwayat ASC')->where(['id_person' => $model->id_person, 'jenis_role' => 3, 'id_jenisriwayat' => $cater->id_jenisriwayat])->all();
        echo '<h5>' . $cater->nama_jenisriwayat . '</h5>';
        echo '<hr>';
        foreach ($items as $itemf => $item) {
            echo '<p>' . Html::a($item->riwayat) . ' (' . $item->tgl_riwayat . ') </p>';
        }
    }

    ?>


    <script>
    </script>

</div>