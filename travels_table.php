<?php
//session_save_path('C:\Users\hnyaga\Desktop\Software\budget app - 5\budget_app_sessions');
session_start();

// Retrieve the stored HTML content from the session variable
$tableBodyHTML = isset($_SESSION['travels_table']) ? $_SESSION['travels_table'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Title</title>
    <!-- Include your style.css file -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Display the table with the stored HTML content -->
    <tbody id="tableBody" style="border-collapse: collapse;">
        <?php echo $tableBodyHTML; ?>
    </tbody>
    <!-- You can include other HTML elements here -->
</body>
</html>