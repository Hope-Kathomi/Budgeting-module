<?php
//session_save_path('C:\Users\hnyaga\Desktop\Software\budget app - 5\budget_app_sessions');
session_start();
class calculateContractual{
    public $Type;
    public $description;
    public $quarter;
    public $quantity;
    public $conn;
    public $incurred_cost;
    public $t_amount;
    public $Unit_cost;
    public $total;
    public $amount;
    public $exchange_rate;
    public $converted_value;

    function __construct($conn, $Type){
        $this->Type = $Type;
        //echo 'type is: ',$this->Type;
        //var_dump($_POST);
        $this->conn = $conn;
        $this->exchange_rate = $_SESSION['exchange_rate'];
        $this->get_gross_pay();
    }

    function get_gross_pay(){
        if(isset($_POST['Type']) && isset($_POST['Quantity'])){ 
            $this->incurred_cost = $_POST['incurred_cost'];
            $sql_query = $this->conn->prepare("SELECT Cost FROM contractuals WHERE Contractual_type = ?");
            $sql_query->bind_param("s", $this->Type);
            $sql_query->execute();
            $result = $sql_query->get_result();
            if($row = $result->fetch_assoc()){
                $this->Unit_cost = $row['Cost'];
                $this->quantity = $_POST['Quantity'];
                $this->t_amount = $this->Unit_cost * $this->quantity;
                $this->amount = $this->t_amount - ($this->t_amount * ($this->incurred_cost/100));
                $this->converted_value = $this->amount / $this->exchange_rate;
                $this->converted_value =$this->formatToTwoDecimalPlaces($this->amount / $this->exchange_rate);
                $this->amount = $this->formatToTwoDecimalPlaces($this->amount);
                
                //$_SESSION['contractual_total'] = $this->amount;
            } else {
                throw new Exception("No cost found for the chosen contractual type.");
            }
        } else {
            throw new Exception("'Type' and 'quantity' are not set.");
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
include('database_connection.php');
$grossPay = new calculateContractual($conn, $_POST['Type']);
$grossPay->display_table();
?>