<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Person */

$this->title = 'Create a New Contact';
// $this->params['breadcrumbs'][] = ['label' => 'List', 'url' => ['person/list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
