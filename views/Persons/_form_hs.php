<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Persons */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="persons-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $model->id_person = $id_person ?>

    <?= $form->field($model, 'id_person')->label(false)->textInput(['styles' => 'display:none' ,'hidden' => true, 'value' => $id_person]) ?>
    <?= $form->field($model, 'jenis_role')->label(false)->textInput(['styles' => 'display:none' ,'hidden' => true, 'value' => $role]) ?>

    <?= $form->field($model, 'id_jenisriwayat')->dropDownList($model_jenis,  ['prompt' => '']);
    ?>
    <?= $form->field($model, 'tgl_riwayat')->widget(yii\jui\DatePicker::classname(), [
        'dateFormat' => 'yyyy-MM-dd',
        "options" => [
            'class' => 'form-control'
        ]]) ?>
    <?= $form->field($model, 'riwayat') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
