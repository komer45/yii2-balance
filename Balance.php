<?php
namespace komer45\balance;

use Yii;
use yii\data\Sort;
use yii\base\Component;
use komer45\balance\models\Score;
use komer45\balance\models\Transaction;
use komer45\balance\models\SearchTransaction;

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
		$model->user_id = Score::find()->where(['id' => $balanceId])->one()->user_id;
		$lastTransaction = Transaction::find()->where(['balance_id' => $balanceId])->orderBy(['id' => SORT_DESC])->one();
		
		if(!$lastTransaction){
			$model->balance = 0;
		}elseif($type == 'in'){	//приход средств
			$model->balance = $lastTransaction->amount+$amount;
		}else{				//расход средств
			$model->balance = $lastTransaction->amount-$amount;
		}

		if($model->save()){
			return $model->id;
		} else {
			die('somethings in addTransaction(Balance.php) went wrong!');
		}
	}
	
}