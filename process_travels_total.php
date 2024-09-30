<?php
//session_save_path('C:\Users\hnyaga\Desktop\Software\budget app - 5\budget_app_sessions');
session_start();

function get_travels_total(){
    if (isset($_POST['total']) && isset($_SESSION['valid'])) {
       // $this->user_pno = $_SESSION['valid'];
        $_SESSION['travels_total'] = $_POST['total'];
        $_SESSION['travels_total_converted_total'] = $_POST['finalConvertedTotal'];

        //echo $_SESSION['travels_total'];
        echo "Session variable 'equipments_total' set successfully.";
    } else {
        if (!isset($_SESSION['valid'])) {
            echo "Session variable 'valid' is not set.";
        }
        if (!isset($_POST['total'])) {
            echo "Total value not provided.";
        }
    }
}
get_travels_total();