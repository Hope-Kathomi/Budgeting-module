<?php
class saveToDatabase{

    public $conn;

    function __construct($conn){
        $this->conn = $conn;
    }
    function save_personnel(){
        if(isset($_POST['total'])) {
            // Sanitize and validate the total amount (you can add additional validation if needed)
            $total = floatval($_POST['total']);
        
            // Insert the total amount into the database
            $sql = "INSERT INTO  dsppgm_db.Budgets (equipment) VALUES ($total)";
            // Execute the SQL statement
            if ($this->conn->query($sql) === TRUE) {
                echo "Total inserted successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . $this->conn->error;
            }
        } else {
            // Handle case when total amount is not sent
            echo "Error: Total amount not received.";
        }
    }
}
include('database_connection.php');
$database =new saveToDatabase($conn);
$database->save_personnel();
?>