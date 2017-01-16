Yii2-balance
==========
Это модуль для реализации кошелька.
Для того, чтобы кошелек автоматически создавался для пользователя нужно модифицировать стандартную модель 'User'(commmon\models\User) следующим образом:

```
...
use komer45\balance\models\Score;
...
	public function afterSave()
	{
		$findUser = Score::find()->where(['user_id' => $this->getId()])->one();
		if (!$findUser){
			$userBalance = new Score;
			$userBalance->user_id = $this->getId();
			$userBalance->balance = 0;
			
			if($userBalance->validate()){
				return $userBalance->save();
			} else die('Uh-oh, somethings went wrong!');
		}
	}
```

Подробное описание будет позднее!
