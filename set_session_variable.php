<?php
//session_save_path('C:\Users\hnyaga\Desktop\Software\budget app - 5\budget_app_sessions');
session_start();

$exchange_rate = $_SESSION['exchange_rate'];

// Get the inputValue from the AJAX request
$inputValue = $_POST['product'];
$inputValue_formatted = number_format($inputValue,2);

$Converted_product = $_POST['Converted_product'];
$Converted_product_formatted = number_format($Converted_product,2);

$converted_indirect_cost = $inputValue / $exchange_rate;
$converted_indirect_cost_formatted = number_format($converted_indirect_cost,2);
$_SESSION['converted_indirect_cost'] =  $converted_indirect_cost_formatted;


$result = $_POST['result'];
$indirect_amount = $_POST['indirect_amount'];

// Set the session variable
//$_SESSION['inputValue'] = $inputValue;
//$_SESSION['inputValue'] = $result;
$_SESSION['indirect_converted_total'] = $Converted_product_formatted;
$_SESSION['indirect_total'] = $indirect_amount;
$_SESSION['inputValue'] = $inputValue_formatted;

// Send a response back to the client
echo "Session variable set successfully.";
?>