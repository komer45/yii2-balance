<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\komer45\balance\models\Transaction */

$this->title = 'Редактировать Транзакцию: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Транзакции', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="transaction-update">

    <?php echo $this->render('_update', [
        'model' => $model,
    ]) ?>

</div>
