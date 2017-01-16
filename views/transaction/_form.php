<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\komer45\balance\models\Transaction */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="transaction-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'balance_id')->textInput() ?>

    <?php echo $form->field($model, 'date')->textInput() ?>

    <?php echo $form->field($model, 'type')->dropDownList([ 'in' => 'In', 'out' => 'Out', ], ['prompt' => '']) ?>

    <?php echo $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'balance')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'user_id')->textInput() ?>

    <?php echo $form->field($model, 'refill_type')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'comment')->textInput() ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
