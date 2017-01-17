<?php
namespace komer45\balance;

use Yii;
use yii\helpers\Html;
use yii\web\Session;
use komer45\balance\models\Score;
use komer45\balance\models\Transaction;

class Module extends \yii\base\Module
{
	public $userModel = 'common\models\user\User';
	public $adminRoles = ['administrator'];
	public $otherRoles = ['user'];
	public $currencyName = 'баллов';
	
	public function init()
    {
		parent::init();
		
		if (!isset($userModel)){
			$this->userModel = Yii::$app->user->identityClass;
		}
    }
	
	public function run()
    {

    }
	
}