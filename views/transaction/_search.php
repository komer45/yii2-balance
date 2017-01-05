<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\komer45\balance\models\SearchTransaction */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="transaction-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'balance_id') ?>

    <?php echo $form->field($model, 'date') ?>

    <?php echo $form->field($model, 'type') ?>

    <?php echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'balance') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'refill_type') ?>

    <?php // echo $form->field($model, 'canceled') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
