<?php

use yii\db\ActiveRecord;

use yii\helpers\Html;
use yii\widgets\ActiveForm;



// use kartik\widgets\ActiveForm;
// use kartik\widgets\FileInput;



/* @var $this yii\web\View */
/* @var $model app\models\Picture */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="picture-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'avatar')->checkbox() ?>

    <?= $form->field($model, 'caption')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'copyright')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>