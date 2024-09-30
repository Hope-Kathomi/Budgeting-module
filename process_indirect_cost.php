<?php
//session_start();

    $exchange_rate = $_SESSION['exchange_rate'];

    $personnel_total = $_SESSION['personnels_total'];
    $personnel_total_unformatted = preg_replace('/[^\d.-]/', '', $personnel_total);
    $personnel_total_float = (float)$personnel_total_unformatted;
    echo 'Personnel set';

    $equipments_total = $_SESSION['equipments_total'];
    $equipments_total_unformatted = preg_replace('/[^\d.-]/', '', $equipments_total);
    $equipments_total_float = (float)$equipments_total_unformatted;

    $supplies_total = $_SESSION['supplies_total'];
    $supplies_total_unformatted = preg_replace('/[^\d.-]/', '', $supplies_total);
    $supplies_total_float = (float)$supplies_total_unformatted;

    $travels_total = $_SESSION['travels_total'];
    $travels_total_unformatted = preg_replace('/[^\d.-]/', '', $travels_total);
    $travels_total_float = (float)$travels_total_unformatted;

    $contractuals_total = $_SESSION['contractuals_total'];
    $contractuals_total_unformatted = preg_replace('/[^\d.-]/', '', $contractuals_total);
    $contractuals_total_float = (float)$contractuals_total_unformatted;

    $others_total = $_SESSION['others_total'];
    $others_total_unformatted = preg_replace('/[^\d.-]/', '', $others_total);
    $others_total_float = (float)$others_total_unformatted;

    var_dump($personnel_total_float);
    var_dump($equipments_total_float);
    var_dump($supplies_total_float);
    var_dump($travels_total_float);

    $total_before_indirect = $personnel_total_float + $equipments_total_float + $supplies_total_float + $travels_total_float
        + $contractuals_total_float + $others_total_float;

    $total_before_indirect_formatted = number_format($total_before_indirect,2);
    
    $total_before_indirect_converted = $total_before_indirect / $exchange_rate;
    $total_before_indirect_converted_formatted = number_format($total_before_indirect_converted,2);

    $_SESSION['total_before_indirect'] = $total_before_indirect_formatted;
    $_SESSION['total_before_indirect_converted'] = $total_before_indirect_converted_formatted;

    //echo "Total".$total_before_indirect;
    //var_dump($_SESSION['total_before_indirect']);