<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\komer45\balance\models\SearchBalanceScore */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Balance Scores';
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
            'user_id',
            'balance',

			['class' => 'yii\grid\ActionColumn', 'template' => '{delete}',  'buttonOptions' => ['class' => 'btn btn-default'], 'options' => ['style' => 'width: 65px;']]
        ],
    ]); ?>

</div>
