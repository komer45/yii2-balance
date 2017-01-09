<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\komer45\balance\models\BalanceScore */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Balance Scores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="balance-score-view">

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'balance',
        ],
    ]) ?>

</div>
