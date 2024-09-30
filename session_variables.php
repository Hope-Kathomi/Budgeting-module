<?php
//session_save_path('C:\Users\hnyaga\Desktop\Software\budget app - 5\budget_app_sessions');
session_start();
if($_SERVER['REQUEST_METHOD']==="POST"){
    if(isset($_POST['funders_currency']) && isset($_POST['exchange_rate'])){
        $funders_currency = $_POST['funders_currency'];
        $exchange_rate = $_POST['exchange_rate'];
        $_SESSION['funders_currency'] = $funders_currency;
        $_SESSION['exchange_rate'] = $exchange_rate;

        echo "Funders currency and exchange rate are set successfully";
    }

}else{
    echo 'pick a currency and enter exchange rate';
}
