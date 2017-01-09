<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\komer45\balance\models\BalanceScore */

$this->title = 'Create Balance Score';
$this->params['breadcrumbs'][] = ['label' => 'Balance Scores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="balance-score-create">

    <?php echo $this->render('_form', [
        'model' => $model,
		'users' => $users
    ]) ?>

</div>
