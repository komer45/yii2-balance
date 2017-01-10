<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\komer45\balance\models\BalanceScore */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Кошельки пользователей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="balance-score-view">

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
				'label' => 'Пользователь',
				'value' =>  function($model) {
					$userModel = Yii::$app->user->identity;			//Для идентифицирования пользователей системы
					$user = $userModel::findOne($model->user_id);	//находим пользователя по данному полю
					return $user->username;								//выводим имя пользователя
				}
			],
            'balance',
        ],
    ]) ?>

</div>
