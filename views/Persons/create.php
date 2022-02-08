<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Persons */

$this->title = 'Create Persons';
$this->params['breadcrumbs'][] = ['label' => 'Persons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="persons-create">

    <?php $form = ActiveForm::begin(); ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <!-- <?= $this->render('_form', [
                'model' => $model,
            ]) ?> -->

    <?= $form->field($model, 'nama') ?>
    <?= $form->field($model, 'nik')->textInput(['type'=>'number']) ?>
    <?= $form->field($model, 'tempat_lahir') ?>
    <?= $form->field($model, 'tgl_lahir')->widget(yii\jui\DatePicker::classname(), [
        'dateFormat' => 'yyyy-MM-dd',
        "options" => [
            'class' => 'form-control'
        ]]) ?>

    <?= $form->field($model, 'jk')
        ->dropDownList([1 => "Laki Laki", 2 => "Perempuan"],  ['prompt' => '']);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>