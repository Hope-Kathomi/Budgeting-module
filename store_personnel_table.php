<?php
//session_save_path('C:\Users\hnyaga\Desktop\Software\budget app - 5\budget_app_sessions');
session_start();

// Retrieve the HTML content sent via AJAX
$tableBodyHTML = $_POST['tableContent'];

// Store the HTML content in a session variable
$_SESSION['personnel_table'] = $tableBodyHTML;

$tableBodyencoded = urlencode($_SESSION['personnel_table']);
$cookie_name = $_SESSION['valid'];
$cookie_value = $tableBodyencoded;
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");

// Echo a response (optional)
echo "Table body HTML stored in session successfully.";
?>