<?php
//session_save_path('C:\Users\hnyaga\Desktop\Software\budget app - 5\budget_app_sessions');
session_start();

// Retrieve the HTML content sent via AJAX
$tableBodyHTML = $_POST['tableContent'];

// Store the HTML content in a session variable
$_SESSION['supplies_table'] = $tableBodyHTML;

// Echo a response (optional)
echo "Table body HTML stored in session successfully.";
?>