<?php
//session_save_path('C:\Users\hnyaga\Desktop\Software\budget app - 5\budget_app_sessions');
//session_start();

$equipments_table  = isset($_SESSION['equipments_table']) ? $_SESSION['equipments_table'] : null;
$supplies_table = isset($_SESSION['supplies_table']) ? $_SESSION['supplies_table'] : null;
//var_dump($equipments_table);

function extract_columns ($table, $columns_to_extract){
    $extracted_data =[];

    if($table){
        $dom = new DomDocument;
        @$dom->loadHTML($table);
        $rows = $dom->getElementsByTagName('tr');
        $total_rows = $rows->length;

        foreach ($rows as $index => $row) {
            // Skip the last row
            if ($index == $total_rows - 1) {
                continue;
            }

            $cells = $row->getElementsByTagName('td');
            $row_data = [];
            foreach ($columns_to_extract as $col_index){
                if ($cells->length > $col_index){
                    $row_data[] = $cells->item($col_index)->textContent;
                }
            }
            if (!empty($row_data)){
                $extracted_data[] = $row_data;
            }
        }        
    }
    return $extracted_data;
}
$columns_to_extract = [0, 1, 3, 4, 5];

$equipments_table_data = extract_columns($equipments_table, $columns_to_extract);
$supplies_table_data = extract_columns($supplies_table, $columns_to_extract);

$combined_table_data = array_merge($equipments_table_data, $supplies_table_data);

$_SESSION['combined_table_data'] = $combined_table_data;
