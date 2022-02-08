<?php
use yii\helpers\Html;
?>
<p>You have entered the following information:</p>

<ul>
    <li><label>Nama</label>: <?= Html::encode($model->nama) ?></li>
    <li><label>NIK</label>: <?= Html::encode($model->nik) ?></li>
    <li><label>Jenis Kelamin</label>: <?= Html::encode($model->jk) ?></li>
    <li><label>Tanggal Lahir</label>: <?= Html::encode($model->tgl_lahir) ?></li>
    <li><label>Tempat Lahir</label>: <?= Html::encode($model->tempat_lahir) ?></li>
</ul>