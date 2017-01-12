<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\data\Sort;

/* @var $this yii\web\View */
/* @var $model common\modules\komer45\balance\models\Transaction */
/* @var $form yii\bootstrap\ActiveForm */
//var_dump($users);
?>

<div class="transaction-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

	<?php

	echo $form->field($model, 'balance_id')->widget(Select2::classname(), [
					'name' => 'SearchScore[user_id]',
					//'model' => $userList,
					'data' => ArrayHelper::map($scores, 'id', 'user.username'),
					//'value' => $scoreses,
					'theme' =>'classic',
					//'options' => ['placeholder' => 'Choose a user ...'],
					'pluginOptions' => [
						'tags' => true,
						'tokenSeparators' => [',', ' '],
						'maximumInputLength' => 10
					],
				]);
				//var_dump($select2->value);
	?>


    <?php echo $form->field($model, 'type')->dropDownList([ 'in' => 'Приход', 'out' => 'Расход', ]) ?>

    <?php echo $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'refill_type')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'comment')->textInput() ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Создать' : 'Hello', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

    <?php ActiveForm::end(); ?>

</div>
