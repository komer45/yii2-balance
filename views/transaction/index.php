<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use komer45\balance\widgets\BalanceWidget;
use yii\data\Sort;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\komer45\balance\models\SearchTransaction */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Транзакции';
$this->params['breadcrumbs'][] = $this->title;
?>
<?
//echo BalanceWidget::widget();
?>
<div class="transaction-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?
$role = (Yii::$app->authManager->getRolesByUser(Yii::$app->user->id));
?>

<?php if(!$_GET['id'] and (Yii::$app->user->can('administrator')))	{
	echo '<p>';
		echo Html::a('Создать транзакцию', ['create'], ['class' => 'btn btn-success']);
	echo '</p>';
	echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
			'rowOptions' => function ($model){
				if($model->type == 'in'){
				  return ['style' => 'background-color:#98FB98;'];
				} else return ['style' => 'background-color:#FFE4E1;'];
			},
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			
			'id',
			
            /*[
					'format' => 'raw',
					'header' => $idSort->link('id'),
					'value' => function($model) {
						return Html::a($model->id, Url::to(['/balance/transaction/view', 'id' => $model->id]), ['class' => 'btn btn-default']);
					}
			],*/
            //'balance_id',
			'amount',
			'balance',
			[
			'format' => 'raw',
			'header' => $userSort->link('user_id'),
			'value' => function($model) {
				$userModel = Yii::$app->user->identity;			//Для идентифицирования пользователей системы
				$user = $userModel::findOne($model->user_id);	//находим пользователя по данному полю
				return $user->username;								//выводим имя пользователя
			},
			'filter' =>  Select2::widget([
					'name' => 'SearchTransaction[user_id]',
					'data'  => ArrayHelper::map($users, 'id', 'username'),
					'options' => ['placeholder' => 'Владелец...'],
					'pluginOptions' => [
						'tags' => true,
						'tokenSeparators' => [',', ' '],
						'maximumInputLength' => 10
					],
				])
			],
            //'date',
            //'type',
			[
					'format' => 'raw',
					'header' => $typeSort->link('type'),
					'value' => function($model) {
						if($model->type == 'in'){
							return 'приход';
						} return 'расход';
					},
					
				'filter' =>  Select2::widget([
					'name' => 'SearchTransaction[type]',
					'data'  => ['in' => 'Приход', 'out' => 'Расход'],
					'options' => ['placeholder' => 'Тип...'],
					'pluginOptions' => [
						'tags' => true,
						'tokenSeparators' => [',', ' '],
						'maximumInputLength' => 10
					],
				])
				
			],
            //'amount',
            //'balance',
            //'user_id',

            'refill_type',
            'canceled',
			//'comment',
			[
					'format' => 'raw',
					'value' => function($model) {
						if(!$model->canceled){
							return Html::a('Отменить', Url::to(['/balance/transaction/transaction-invert', 'id' => $model->id]), ['class' => 'btn btn-default']);
						}else return 'Отменено';
					}
			],
            //['class' => 'yii\grid\ActionColumn'],
			['class' => 'yii\grid\ActionColumn', 'template' => '{view}', 'options' => ['style' => 'width: 40px;']]
        ],
	]);} 
		elseif (Yii::$app->user->can('user') and ($_GET['id'] == Yii::$app->user->id)) {
			echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
			'rowOptions' => function ($model){
				if($model->type == 'in'){
				  return ['style' => 'background-color:#98FB98;'];
				} else return ['style' => 'background-color:#FFE4E1;'];
			},
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'date',
            //'type',
			[
				'format' => 'raw',
					'header' => $typeSort->link('type'),

					'value' => function($model) {
						if($model->type == 'in'){
							return 'приход';
						} return 'расход';
					},
					
				'filter' =>  Select2::widget([
					'name' => 'SearchTransaction[type]',
					'data'  => ['in' => 'Приход', 'out' => 'Расход'],
					'options' => ['placeholder' => 'Тип...'],
					'pluginOptions' => [
						'tags' => true,
						'tokenSeparators' => [',', ' '],
						'maximumInputLength' => 10
					],
				])
				
			],
            'amount',
            'comment',

            //['class' => 'yii\grid\ActionColumn'],
			['class' => 'yii\grid\ActionColumn', 'template' => '{view}', 'options' => ['style' => 'width: 40px;']]
        ],
]);} ?>

</div>
