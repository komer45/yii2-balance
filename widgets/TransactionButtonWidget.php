<?php
namespace komer45\balance\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use komer45\balance\models\Transaction;

class TransactionButtonWidget extends Widget{
	 
	public function init()
	{
		parent::init();
		return true;
	}
	
	public function run()
	{
		echo Html::a('Транзакции', Url::to(['/balance/transaction']));
	}
	
}