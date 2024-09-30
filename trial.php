<?php
$fileName = '22054 budget.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $fileName . '"');
readfile("Budgets/22054 budget.xlsx");
header('Cache-Control: max-age=0');


exit;
?>