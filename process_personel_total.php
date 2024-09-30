<?php
//session_save_path('C:\Users\hnyaga\Desktop\Software\budget app - 5\budget_app_sessions');
session_start();
include('database_connection.php'); 
include_once('process_personel_budget.php');


function get_personnel_total(){
    if (isset($_POST['total']) && isset($_SESSION['valid'])) {
       // $this->user_pno = $_SESSION['valid'];
       //$converted_total = $_POST['finalConvertedTotal'];
        echo $_POST['total'];
        $_SESSION['personnels_total'] = $_POST['total'];
        $_SESSION['personnels_converted_total'] = $_POST['finalConvertedTotal'];
        echo "Session variable 'personnel_total' set successfully.";
    } else {
        if (!isset($_SESSION['valid'])) {
            echo "Session variable 'valid' is not set.";
        }
        if (!isset($_POST['total'])) {
            echo "Total value not provided.";
        }
    }
}
function save_in_database($data){
    global $conn;
    $stmt = $conn->prepare("INSERT INTO budget_personnel 
    (Designation, Status, Role, Number_of_staff, Period, Step, FTE, Subscriptions, Amount_KSH, Amount_other)VALUES(?,?,?,?,?,?,?,?,?,?)");
    if($stmt){
        $stmt->bind_param("sssiissidd", $data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8], $data[9]);
        if ($stmt->execute()) {
            echo "Data inserted successfully!";
        } else {
            echo "Error inserting data: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}
get_personnel_total();
save_in_database($data);