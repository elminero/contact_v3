<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Person */
$this->title = 'Select Picture for Edit';

$this->params['breadcrumbs'][] = ['label' => 'People', 'url' => ['index']];

$this->params['breadcrumbs'][] = ['label' =>  "Profile " . $model->id, 'url' => ['person/view', 'id' => $model->id], ];

$this->params['breadcrumbs'][] = ['label' =>  $this->title,];


?>


<?php
foreach( $model->pictures as $picture ): ?>


    <div style="margin: 10px;">

        <div style="float: left">
        <?php
        echo Html::a('<img src=" ' . Yii::$app->getUrlManager()->getBaseUrl() . '/pictures/' . $picture->file_name . '_t.jpg" /> ',
            ['picture/display', 'id' => $picture->id], ['class' => '']);
        ?>
        </div>

        <div style="float: left; margin-left: 10px;">
            <span style="color: red"><?php if($picture->avatar){echo "Avatar";} ?><br/></span>
            Caption: <?php echo $picture->caption; ?><br />
            Copyright: <?php echo $picture->copyright; ?><br />
            Date Uploaded: <?php echo $picture->date_entered; ?><br />
            Date Updated: <?php echo $picture->date_updated; ?><br />
        </div>

        <div style="clear: both"></div>

        <div style="float: left; margin-left: 10px; width: 155px">

            <div style="float: left">
                <?php
                echo Html::a('Edit',['picture/update', 'id' => $picture->id, ],  ['class' => '']);
                ?>
            </div>

            <div style="float: right">

                <?php
                echo Html::a('delete',['person/select', 'id' => $picture->person_id, 'remove' => $picture->id],  ['class' => '']);
                ?>


            </div>

        </div>



        <div style="clear: both"></div>

        <hr />

    </div>



<?php
endforeach ?>

<?php
/*
 *
 *  ["id"]=>
    string(3) "132"
    ["person_id"]=>
    string(2) "10"
    ["live"]=>
    int(1)
    ["avatar"]=>
    int(0)
    ["file_name"]=>
    string(20) "15/03/13/14/b181eaa4"
    ["caption"]=>
    string(0) ""
    ["copyright"]=>
    string(0) ""
    ["user_id_created"]=>
    NULL
    ["date_entered"]=>
    string(19) "2015-03-13 14:18:46"
    ["date_updated"]=>
    NULL
    ["ip_created"]=>
    string(3) "::1"
    ["ip_updated"]=>
 *
 *
 *
 *
 *
 */

