<?php

if($_SERVER['REQUEST_METHOD']==="POST"){
    $funders_currency = $_POST['funders_currency'];
    echo $funders_currency;
}else{
    header("location: currency.php");
}