<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use komer45\balance\widgets\BalanceWidget;

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

<?php if(!$_GET['id'])	{?>
    <?php echo GridView::widget([
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
            'type',
            //'amount',
            //'balance',
            'user_id',
            'refill_type',
            'canceled',
			//'comment',
			[
					'format' => 'raw',
					'value' => function($model) {
						return Html::a('Обратить', Url::to(['/balance/transaction/transaction-invert', 'id' => $model->id]), ['class' => 'btn btn-default']);
					}
			],
            ['class' => 'yii\grid\ActionColumn'],
        ],
	]);} 
		else {?>
	
 <?php echo GridView::widget([
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
