<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\komer45\balance\models\Transaction */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Транзакции', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-view">

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'balance_id',
            'date',
			[
				'label' => 'Тип',
				'value' => function($model){
					if ($model->type == 'in'){
						return 'Приход';
					}else {
						return 'Расход';
					}
				}
			],
            'amount',
            'balance',
			[
				'label' => 'Пользователь',
				'value' =>  function($model) {
					$userModel = Yii::$app->user->identity;			//Для идентифицирования пользователей системы
					$user = $userModel::findOne($model->user_id);	//находим пользователя по данному полю
					return $user->username;								//выводим имя пользователя
				}
			],
            'refill_type',
            'canceled',
			'comment'
        ],
    ]) ?>

</div>
