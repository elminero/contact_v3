<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2><?php
                    echo Html::a('List', ['person/index'], ['class' => '']);
                    ?>
                </h2>

                <p>
                    Name: Farber Robert Ian<br/>
                    Alias: Robby<br/>
                    DOB: November 27, 1964<br/>
                    Age: 50<br/>
                    Note: The quick brown fox
                </p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>
                    Name: Farber Robert Ian<br/>
                    Alias: Robby<br/>
                    DOB: November 27, 1964<br/>
                    Age: 50<br/>
                    Note: The quick brown fox
                </p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>
                    Name: Farber Robert Ian<br/>
                    Alias: Robby<br/>
                    DOB: November 27, 1964<br/>
                    Age: 50<br/>
                    Note: The quick brown fox
                </p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
