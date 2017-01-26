<?php
namespace komer45\balance\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use komer45\balance\models\Score;

class BalanceWidget extends Widget{
	 
	public function init()
	{
		parent::init();
		return true;
	}
	
	public function run()
	{
		$return = '<h4>';
		if(Yii::$app->user->id){
			$score = Score::find()->where(['user_id' => Yii::$app->user->id])->one()->balance;
			echo $return.Yii::$app->balance->currencyName.
			Html::a(' на счете ', Url::to(['/balance/transaction/partner-index', 'id' => Yii::$app->user->id])).
			$score.$return = '</h4>';
			return $return;
		}
	}
	
}