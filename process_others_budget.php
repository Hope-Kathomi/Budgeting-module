<?php
//session_save_path('C:\Users\hnyaga\Desktop\Software\budget app - 5\budget_app_sessions');
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        // Include database connection
        include('database_connection.php');

        //echo '<pre>';
        //print_r($_POST);
        //echo '</pre>';

        // Check if Type is set in $_POST
        if(isset($_POST['Type'])) {
            $Type = $_POST['Type'];
            //echo '<pre>';
            //print_r($Type);
            //echo '</pre>';
            // Instantiate calculateGrossPay class
            $grossPay = new calculateOthers($conn, $Type);
            $grossPay->display_table();
            
        } else {
            throw new Exception("Type of activity is not set in the form submission.");
        }
    } catch (Exception $e) {
        // Echo the actual error
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Form not submitted.";
}

class calculateOthers{
    public $Type;
    public $description;
    public $quarter;
    public $quantity;
    public $conn;
    public $Unit_cost;
    public $total;
    public $amount;
    public $exchange_rate;
    public $converted_value;
    

    function __construct($conn, $Type){
        if(isset($_SESSION['exchange_rate'])){
            $session = $_SESSION['exchange_rate'];
            //echo "<pre>";
            //print_r($session);
            //echo "</pre>";
            $this->Type = $Type;
            $this->conn = $conn;
            $this->exchange_rate = $_SESSION['exchange_rate'];
            $this->get_gross_pay();
        }else{
            echo 'session"exchange_rate" not set';
        }
        
    }

    function get_gross_pay(){
        if(isset($_POST['Type']) && isset($_POST['Quantity'])){ 
            $sql_query = $this->conn->prepare("SELECT Cost FROM others WHERE Contractual_type = ?");
            $sql_query->bind_param("s", $this->Type);
            $sql_query->execute();
            $result = $sql_query->get_result();
            if($row = $result->fetch_assoc()){
                $this->Unit_cost = $row['Cost'];
                $this->quantity = $_POST['Quantity'];
                $this->amount = $this->Unit_cost * $this->quantity;
                $this->converted_value = $this->amount / $this->exchange_rate;
                $this->converted_value =$this->formatToTwoDecimalPlaces( $this->converted_value);
                $this->amount = $this->formatToTwoDecimalPlaces($this->amount);
                //$_SESSION['others_total'] = $_POST['finalTotal'];
                //$_SESSION['other_total_converted_total'] = $_POST['finalConvertedTotal'];
            } else {
                throw new Exception("No cost found for the given contractual type.");
            }
        } else {
            throw new Exception("Required form inputs are not set.");
        }   
    } 
    private function formatToTwoDecimalPlaces($value) {
        return number_format($value, 2, '.', ',');
    }

    function display_table(){
        if(isset($_POST['Description']) && isset($_POST['Quarter'])){
            $this->description = $_POST['Description'];
            $this->quarter = $_POST['Quarter'];
            //$this->period = $_POST['period'];

            // Create a new row for the table and populate it with form data
            $newRow = "<tr><td>$this->Type</td><td>$this->quantity</td><td>$this->description</td><td>$this->Unit_cost</td><td>$this->quarter</td>
            <td>$this->amount</td><td>{$this->converted_value}</td></tr>";

            // Echo the new row to send it back to the JavaScript success function
            echo $newRow;
        } else {
            throw new Exception("Required form inputs for table display are not set.");
        }
    }
}
