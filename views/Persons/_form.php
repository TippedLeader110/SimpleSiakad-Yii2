<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Persons */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="persons-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama') ?>
    <?= $form->field($model, 'nik')->textInput(['type'=>'number']) ?>
    <?= $form->field($model, 'tempat_lahir') ?>
    <?= $form->field($model, 'tgl_lahir')->widget(yii\jui\DatePicker::classname(), [
        'dateFormat' => 'yyyy-MM-dd',
        "options" => [
            'class' => 'form-control'
        ]]) ?>

    <?= $form->field($model, 'jk')->dropDownList([1 => "Laki Laki", 2 => "Perempuan"],  ['prompt' => '']);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
