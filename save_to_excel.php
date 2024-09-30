<?php
//session_save_path('C:\Users\hnyaga\Desktop\Software\budget app - 5\budget_app_sessions');
session_start();
require 'vendor/autoload.php'; // Include PhpSpreadsheet autoload file

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

try {
    // Clear any existing output buffers
    if (ob_get_length()) {
        ob_end_clean();
    }

    // Create a new Spreadsheet object
    $spreadsheet = new Spreadsheet();

    // List of tables stored in session
    $tables = [
        'Summary budget' => $_POST['summary'] ?? '',
        'Personnel budget' => $_SESSION['personnel_table'] ?? '',
        'Equipments budget' => $_SESSION['equipments_table'] ?? '',
        'Supplies budget' => $_SESSION['supplies_table'] ?? '',
        'Travels budget' => $_SESSION['travels_table'] ?? '',
        'Contractuals budget' => $_SESSION['contractuals_table'] ?? '',
        'Others budget' => $_SESSION['others_table'] ?? '',
        // Add more tables as needed
    ];

    foreach ($tables as $sheetTitle => $htmlTable) {
        if (empty($htmlTable)) {
            continue; // Skip empty tables
        }

        // Create a new worksheet for each table
        $sheet = $spreadsheet->createSheet();
        $sheet->setTitle($sheetTitle);

        // Load HTML table data into a DOMDocument
        $dom = new DOMDocument();
        @$dom->loadHTML($htmlTable); // Use @ to suppress warnings for invalid HTML

        // Get all table rows
        $rows = $dom->getElementsByTagName('tr');

        // Loop through each row and add data to the Excel sheet
        $rowIndex = 1;
        foreach ($rows as $row) {
            $cells = $row->getElementsByTagName('td');
            $colIndex = 1;
            
            foreach ($cells as $cell) {
                $columnLetter = Coordinate::stringFromColumnIndex($colIndex); // Convert column index to letter
                $cellAddress = $columnLetter . $rowIndex; // Create cell address
                $sheet->setCellValue($cellAddress, $cell->nodeValue); // Set cell value
                $colIndex++;
            }
            $rowIndex++;
        }
    }

    // Remove the default sheet created with the spreadsheet
    $spreadsheet->removeSheetByIndex(0);

    // Create a writer
    $writer = new Xlsx($spreadsheet);

    // Filename
    $fileName = ($_SESSION['valid'] ?? 'default') . ' budget.xlsx';

    // Set headers to force download
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . $fileName . '"');
    header('Cache-Control: max-age=0'); // Disables caching

    // Output the file
    $writer->save('php://output');
    exit; // Terminate script after output
} catch (Exception $e) {
    // Output the error message
    echo 'Error: ' . $e->getMessage();
}
?>
