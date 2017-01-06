<?php
namespace komer45\balance;

use Yii;
use yii\base\Component;
use komer45\balance\models\Score;
use komer45\balance\models\Transaction;

class Balance extends Component{
	
	public $currencyName = 'rub';
	public $adminRoles = ['admin'];
	public $otherRoles = ['user'];
	 
	public function init()
	{
			parent::init();
	}
	
	public function getUserScore($userId = null)
	{
		if ($userId){
			return $userScore = Score::find()->where(['user_id' => $userId])->one();
		}
		return $userScore = Score::find()->where(['user_id' => Yii::$app->user->id])->one();

	}

	public function addTransaction($balanceId, $type, $amount, $refillType = null)
	{
		$model = new Transaction;
		$model->balance_id = $balanceId;
		$model->type = $type;
		$model->amount = $amount;
		$model->refill_type = $refillType;
		$model->date = date('Y-m-d H:i:s');
		if($model->save()){
			return $model->id;
		} else {
			die('somethings in addTransaction(Balance.php) went wrong!');
		}
	}
	
}