<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use komer45\balance\widgets\BalanceWidget;
use yii\data\Sort;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\komer45\balance\models\SearchTransaction */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transactions';
$this->params['breadcrumbs'][] = $this->title;
?>
<?
echo BalanceWidget::widget();
?>
<div class="transaction-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Создать транзакцию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<?
$role = (Yii::$app->authManager->getRolesByUser(Yii::$app->user->id));
//echo '<pre>'; var_dump ($role);
?>

<?php if(!$_GET['id'] and (Yii::$app->user->can('administrator')))	{
	echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
					'format' => 'raw',
					'header' => 'Id',
					'value' => function($model) {
						return Html::a($model->id, Url::to(['/balance/transaction/view', 'id' => $model->id]), ['class' => 'btn btn-default']);
					}
			],
            'balance_id',
            //'date',
            //'type',
			[
					'format' => 'raw',
					'header' => $typeSort->link('type'),
					'value' => function($model) {
						if($model->type == 'in'){
							return 'приход';
						} return 'расход';
					}
			],
            //'amount',
            //'balance',
            'user_id',
            'refill_type',
            'canceled',
			//'comment',
			[
					'format' => 'raw',
					'value' => function($model) {
						return Html::a('Отменить', Url::to(['/balance/transaction/transaction-invert', 'id' => $model->id]), ['class' => 'btn btn-default']);
					}
			],
            ['class' => 'yii\grid\ActionColumn'],
			['class' => 'yii\grid\ActionColumn', 'template' => '{update}',  'buttonOptions' => ['class' => 'btn btn-default'], 'options' => ['style' => 'width: 65px;']]
        ],
	]);} 
		elseif (Yii::$app->user->can('user') and ($_GET['id'] == Yii::$app->user->id)) {
			echo 'hello';
			echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'date',
            'type',
            'amount',
            'comment',

            ['class' => 'yii\grid\ActionColumn'],
			
        ],
]);} ?>

</div>
