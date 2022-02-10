<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Persons */

$this->title = 'Tambah Riwayat';
$this->params['breadcrumbs'][] = ['label' => 'Persons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="persons-create">

    <?php $form = ActiveForm::begin(); ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_hs', [
                'model' => $model,
                'model_jenis' => $model_jenis,
                'id_person' => $id_person,
                'role' => $role
            ]) ?>

    <?php ActiveForm::end(); ?>
</div>