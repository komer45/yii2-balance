<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\komer45\balance\models\BalanceScore */

$this->title = 'Редактирование Кошелька: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Balance Scores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="balance-score-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
