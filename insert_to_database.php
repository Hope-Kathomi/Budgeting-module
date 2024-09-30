<?php
session_start();
class saveToDatabase{

    public $conn;

    function __construct($conn){
        $this->conn = $conn;
    }
    function save_personnel(){
        if(isset($_POST['total'])){
            if (isset($_SESSION['valid'])){
            
                // Sanitize and validate the total amount (you can add additional validation if needed)
                $total = floatval($_POST['total']);
                $s_id = $_SESSION['valid'];
                echo "session id:".($s_id);
                $pdo = new PDO('mysql:host=localhost;dbname=dsppgm_db', 'root', 'sqlAdmin!1');
        
                // Insert the total amount into the database
                $sql = "INSERT INTO dsppgm_db.Budgets (P_no, Personnel) VALUES (:sess_id, :total)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':sess_id', $s_id);
                $stmt->bindParam(':total', $total);
                $stmt->execute();
            }
            else {
                    // Handle case when total amount is not sent
                    echo "Error: Session not valid.";
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