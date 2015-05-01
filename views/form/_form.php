<?php

use yii\helpers\Html;
use matacms\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model mata\form\models\Form */
/* @var $form yii\widgets\ActiveForm */

yii\gii\GiiAsset::register($this);
?>

<div class="form-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Name')->textInput(['maxlength' => 128]) ?>
    <?php
    $options = [];
    if (!$model->isNewRecord) {
        $options['options'] = ['disabled' => 'disabled'];
    }
    ?>
    <?= $form->field($model, 'ReferencedTable')->dropDownList($model->findFormTableNames(), $options); ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
