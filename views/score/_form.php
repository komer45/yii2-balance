<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\data\Sort;

/* @var $this yii\web\View */
/* @var $model common\modules\komer45\balance\models\BalanceScore */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="balance-score-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>
	
	<?php

	echo $form->field($model, 'user_id')->widget(Select2::classname(), [
					'name' => 'SearchScore[user_id]',
					'data' => ArrayHelper::map($users, 'id', 'username'),
					'theme' =>'classic',
					'pluginOptions' => [
						'tags' => true,
						'tokenSeparators' => [',', ' '],
						'maximumInputLength' => 10
					],
				]);

	?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Создать' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
