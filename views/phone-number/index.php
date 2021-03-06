<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Phone Numbers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phone-number-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Phone Number', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'person_id',
            'live',
            'type',
            'phone',
            // 'note:ntext',
            // 'user_id_created',
            // 'date_entered',
            // 'date_updated',
            // 'ip_created',
            // 'ip_updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
