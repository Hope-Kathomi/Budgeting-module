<?php
//session_save_path('C:\Users\hnyaga\Desktop\Software\budget app - 5\budget_app_sessions');
session_start();

$final_total = $_POST['finalTotal'];
var_dump($final_total);
$final_converted_total = $_POST['finalConvertedTotal'];
var_dump($final_converted_total);

if (isset($_POST['finalTotal']) && isset($_SESSION['valid'])) {
    // $this->user_pno = $_SESSION['valid'];
     $_SESSION['contractuals_total'] = $final_total;
     $_SESSION['contractual_converted_total'] = $final_converted_total;
     //echo $_SESSION['others_total'];
 } else {
     if (!isset($_SESSION['valid'])) {
         echo "Session variable 'contractuals_total' is not set.";
     }
     if (!isset($_POST['total'])) {
         echo "Total value not provided.";
     }
 }