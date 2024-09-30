<?php
// Initialize total amounts

use PhpOffice\PhpSpreadsheet\Calculation\Engine\FormattedNumber;

$total_amount_ksh = 0;
$total_amount_other = 0;

// Arrays containing the session variable names
$ksh_totals = [
    'personnels_total', 
    'equipments_total', 
    'supplies_total', 
    'travels_total', 
    'contractuals_total', 
    'others_total', 
    'inputValue'
];

$other_totals = [
    'personnels_converted_total', 
    'equipments_total_converted_total', 
    'supplies_total_converted_total', 
    'travels_total_converted_total', 
    'contractual_converted_total', 
    'other_total_converted_total', 
    'indirect_converted_total'
];

// Calculate total for AMOUNT (ksh)
for ($i = 0; $i < count($ksh_totals); $i++) {
    if (isset($_SESSION[$ksh_totals[$i]])) {
        // Remove formatting (e.g., commas)
        $clean_number_string = str_replace(',', '', $_SESSION[$ksh_totals[$i]]);

        $numeric_value = floatval($clean_number_string);
        
        // Check if the cleaned string is numeric and add to total
        if (is_numeric($numeric_value)) {
            $total_amount_ksh += $numeric_value;
            //echo $_SESSION[$ksh_totals[$i]] . ' cleaned to ' . $clean_number_string . '<br>';
        } else {
            echo $_SESSION[$ksh_totals[$i]] . ' is not numeric after cleaning<br>';
        }
    } else {
        echo $ksh_totals[$i] . ' is not set<br>';
    }
}

// Calculate total for AMOUNT (other)
for ($i = 0; $i < count($other_totals); $i++) {
    if (isset($_SESSION[$other_totals[$i]])) {
        // Remove formatting (e.g., commas)
        $clean_number_string = str_replace(',', '', $_SESSION[$other_totals[$i]]);

        $numeric_value = floatval($clean_number_string);
        
        // Check if the cleaned string is numeric and add to total
        if (is_numeric($numeric_value)) {
            $total_amount_other += $numeric_value;
        }
    }
}

$formmated_total = number_format($total_amount_ksh,2);
$formmated_converted_total = number_format($total_amount_other,2);
// Display the total values
$_SESSION['totals'] = $formmated_total;
$_SESSION['total_converted_totals'] = $formmated_converted_total;

//echo "Total Amount (ksh): " . $_SESSION['totals'];
//echo "<br>";
//echo "Total Amount (other): " . $_SESSION['total_converted_totals'];
?>