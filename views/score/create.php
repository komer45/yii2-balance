<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\komer45\balance\models\BalanceScore */

$this->title = 'Создать новый кошелк';
$this->params['breadcrumbs'][] = ['label' => 'Кошельки пользователей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="balance-score-create">

    <?php echo $this->render('_form', [
        'model' => $model,
		'users' => $users
    ]) ?>

</div>
