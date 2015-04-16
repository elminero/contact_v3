<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Person */

?>

    <div style="float: left"><!--Start BreadCrumbs div 1-->
        <?php
        $this->title = 'Picture';

        //     Home People Profile Portfolio Picture


        $this->params['breadcrumbs'][] = ['label' => 'People', 'url' => ['index']];

        $this->params['breadcrumbs'][] = ['label' =>  "Profile " . $model->id, 'url' => ['person/view', 'id' => $model->id], ];

        $this->params['breadcrumbs'][] = ['label' =>  "Portfolio " . $model->id, 'url' => ['person/portfolio', 'id' => $model->id], ];

        $this->params['breadcrumbs'][] = ['label' =>  $this->title,  ];

        ?>
    </div><!--End BreadCrumbs div 1-->


<?php


echo "picturePage";