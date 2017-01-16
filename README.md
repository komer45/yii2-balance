Yii2-balance
==========
Это модуль для реализации кошелька пользователя. Кошелек создается автоматически для нового пользователя, так же можно создать кошелек для уже существующего пользователя, или для всех пользователей, у которых еще нет кошелька, по нажатию на соответствующую кнопку на странице кошельков пользователей.
Установка
---------------------------------
Выполнить команду

```
php composer require komer45/yii2-balance "*"
```

Или добавить в composer.json

```
"komer45/yii2-balance": "*",
```

И выполнить

```
php composer update
```

Далее, мигрируем базу:

```
php yii migrate --migrationPath=vendor/komer45/yii2-balance/migrations
```

Подключение и настройка
---------------------------------
Для пользования необходимо подключить модуль в конфиге:

```'php'
	'modules' => [
		'balance' => [
				'class' => 'komer45\balance\Module',
				'adminRoles' => ['superadmin', 'administrator'],
				'otherRoles' => ['manager', 'user']
				],
	...
	]
```
Для доступа к компоненту (в данном модуле - для совершения) в том же конфиге необходимо подключить обращение:
```'php'
	'components' => [
	...
		'balance' => [
			'class' => 'komer45\balance\Balance'
		],
	...
	]
```

Если данный модуль предполагается использовать совместно с модулем yii2-partnership, то в конфиге к модулю partnership необходимо подписаться на событие совершения операции перевода данного модуля:
```php
'partnership' => [
            'class' => 'komer45\partnership\Module',
            'layout' => 'main',
			'adminRoles' => ['superadmin', 'administrator'],
				'on makePayment' => function($event){
					$model = $event->model;
					$userId = Yii::$app->Partnership->getUserByPartnerId($model->partner_id);
					$balance = Yii::$app->balance->getUserScore($userId);
					Yii::$app->balance->addTransaction($balance->id, 'in', $model->sum, 'partnership rewads');
				}
],
```
Для того, чтобы кошелек автоматически создавался для пользователя нужно модифицировать стандартную модель 'User'(commmon\models\User) следующим образом:

```'php'
...
use komer45\balance\models\Score;
...
	public function afterSave($p1, $p2)
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
В этой же модели (ниже) необходимо добавить метод getScore, который отвечает за получение текущего остатка пользователя:

```'php'
public function getScore($userId = null)
	{
			if ($userId){
				return $userScore = Score::find()->where(['user_id' => $userId])->one()->balance;
			}
			return $userScore = Score::find()->where(['user_id' => Yii::$app->user->id])->one()->balance;
	}
```
Если модель подключаемого User не соответствует 'common\models\User' то ее необходимо задать в Модуле(Module.php) изменив переменную $userModule;