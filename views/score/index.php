<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\Sort;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\komer45\balance\models\SearchBalanceScore */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Кошельки пользователей';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="balance-score-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php 	
				echo Html::a('Создать новый личный счет', ['create'], ['class' => 'btn btn-success']);  
				echo "<span style='padding-left:10px;'> </span>";
				echo Html::a('Создать счета', ['balances'], ['class' => 'btn btn-primary grid-button'])
		?>
    </p>


    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'user_id',
			[
					'format' => 'raw',
					'header' => $sort->link('user_id'), 
					'value' => function($model) {
						$userModel = Yii::$app->user->identity;			//Для идентифицирования пользователей системы
						$user = $userModel::findOne($model->user_id);	//находим пользователя по данному полю
						if(!$user){
							return false;
						}
						return $user->name;								//выводим имя пользователя
					},
					'filter' =>  Select2::widget([
					'name' => 'SearchScore[user_id]',
					'data'  => ArrayHelper::map($users, 'id', 'username'),
					'options' => ['placeholder' => 'Владелец...'],
					'pluginOptions' => [
						'tags' => true,
						'tokenSeparators' => [',', ' '],
						'maximumInputLength' => 10
					],
				])
			],
            'balance',

			['class' => 'yii\grid\ActionColumn', 'template' => '{delete}',  'buttonOptions' => ['class' => 'btn btn-default'], 'options' => ['style' => 'width: 65px;']]
        ],
    ]); ?>

</div>
