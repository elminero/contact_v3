<?php
use yii\helpers\Html;




foreach($namesWithAddress as $name) {

    $nameAddress =

    $name["last_name"];

    if($name["last_name"] && $name["first_name"]) $nameAddress .= ", " . $name["first_name"];

    if( ($name["last_name"] || $name["first_name"]) && $name["middle_name"]) $nameAddress .= ", " . $name["middle_name"];

    if($name["alias_name"])  $nameAddress .= "<br />Alias: " . $name["alias_name"];


    $nameAddress .= "<br />";

    $nameAddress .= $name["street"];

    if($name["street"] && $name["city"]) $nameAddress .= ", " . $name["city"];

    if( ($name["street"] || $name["city"]) && $name["state"]) $nameAddress .= ", " . $name["state"]. " " . $name["postal_code"] . " " .$name["iso"];


  //  echo $nameAddress; ['post/index', 'page' => 2]


    echo Html::a($nameAddress, ['person/profile', 'id'=>$name["id"]], ['class' => '']);


    echo "<hr />";

/*
        . $name["first_name"] . $name["middle_name"] . $name["alias_name"] .










        $name["street"] . $name["city"] . $name["state"] . $name["postal_code"] . $name["iso"] . "<br />";
*/



}


/*
array(8) { ["last_name"]=> string(6) "Farber" ["first_name"]=> string(6) "Robert" ["middle_name"]=> string(4) "Ian " ["alias_name"]=> string(5) "Robby" ["street"]=> string(14) "4660 Oregon St" ["city"]=> string(9) "San Diego" ["state"]=> string(10) "California" ["iso"]=> string(2) "US" }
array(8) { ["last_name"]=> string(8) "Peterson" ["first_name"]=> string(5) "Scott" ["middle_name"]=> string(3) "Roy" ["alias_name"]=> string(11) "Wife Killer" ["street"]=> NULL ["city"]=> NULL ["state"]=> NULL ["iso"]=> NULL }
*/