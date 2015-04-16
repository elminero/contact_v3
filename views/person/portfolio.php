<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Person */

?>

<div style="float: left"><!--Start BreadCrumbs div 1-->
    <?php
    $this->title = 'Portfolio';

//     Home People Profile Portfolio


    $this->params['breadcrumbs'][] = ['label' => 'People', 'url' => ['index']];

    $this->params['breadcrumbs'][] = ['label' =>  "Profile " . $model->id, 'url' => ['person/view', 'id' => $model->id], ];

    $this->params['breadcrumbs'][] = ['label' =>  $this->title,  ];

    ?>
</div><!--End BreadCrumbs div 1-->


<?php


foreach($model->pictures as $picture): ?>
    <div class="col-lg-2">
        <p>
        <?php
        echo Html::a('<img src=" ' . Yii::$app->getUrlManager()->getBaseUrl() . '/pictures/' . $picture->file_name . '_t.jpg" /> ',
            ['picture/display', 'id' => $picture->id], ['class' => '']);
        ?>
        </p>


    </div>
<?php endforeach; ?>







