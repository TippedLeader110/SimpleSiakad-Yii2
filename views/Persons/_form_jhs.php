<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Persons */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="persons-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_jenisriwayat') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
