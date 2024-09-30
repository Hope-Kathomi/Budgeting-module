<?php
//session_save_path('C:\Users\hnyaga\Desktop\Software\budget app - 5\budget_app_sessions'); 
session_start();

class calculateSuppliesBudget {
    public $step;
    public $Item;
    public $conn;
    public $sub_category;
    public $price;
    public $description;
    public $quarter;
    public $quantity;
    public $Unit_cost;
    public $unit;
    public $amount;
    public $total_price;
    public $catalogue_No;
    public $user_pno;
    public $exchange_rate;
    public $converted_value;
    
    function __construct($conn) {
        $this->conn = $conn;
        
        $this->get_unit_price();
    }
    
    function get_unit_price() {
        if (isset($_POST['sub_equipments']) && !empty($_POST['sub_equipments'])) {
            $this->Item = $_POST['sub_equipments'];
            $this->quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 0;
            $this->exchange_rate = $_SESSION['exchange_rate'];
            $this->quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 0;
            $sql_query = "SELECT price, Catalogue_No FROM equipment WHERE sub_category = '$this->Item'";
            $result = $this->conn->query($sql_query);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $this->price = $row['price'];
                $this->catalogue_No =$row['Catalogue_No'];
                $this->total_price = $this->price * $this->quantity;
                $this->converted_value =$this->formatToTwoDecimalPlaces($this->total_price / $this->exchange_rate);
                $this->total_price = $this->formatToTwoDecimalPlaces($this->total_price);
            } else {
                $this->price = $_POST['other_unit_cost'];
                //$this->price = 0;
                $this->total_price = 0;
                echo "Item not found in database.";
            }
        } else {
            echo "Item not set or empty.";
        }
        if (isset($_POST['type_of_equipment']) && $_POST['type_of_equipment'] === 'Other'){
            $this->price = $_POST['other_unit_cost'];
            $this->quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 0;
            $this->total_price = $this->price * $this->quantity;
            $this->exchange_rate = $_SESSION['exchange_rate'];
            $this->converted_value =$this->formatToTwoDecimalPlaces($this->total_price / $this->exchange_rate);
        }
    }
    private function formatToTwoDecimalPlaces($value) {
        return number_format($value, 2, '.', ',');
    }

    function get_equipment_total(){
        if (isset($_POST['total']) && isset($_SESSION['valid'])) {
           //var_dump($_POST['total']);
            $_SESSION['equipments_total'] = $_POST['total'];
            $_SESSION['equipments_total_converted_total'] = $_POST['finalConvertedTotal'];
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
    
    function display_table() {
        $this->Item;
        if (isset($_POST['sub_equipments']) && !empty($_POST['sub_equipments'])) {
            $this->Item = $_POST['sub_equipments'];
        } elseif (isset($_POST['other_sub_equipment']) && !empty($_POST['other_sub_equipment'])) {
            $this->Item = $_POST['other_sub_equipment'];
        }


        //$this->Item = isset($_POST['sub_equipments']) ? $_POST['sub_equipments'] : '';
        $this->description = isset($_POST['description']) ? $_POST['description'] : '';
        $this->quarter = isset($_POST['quarter']) ? $_POST['quarter'] : '';
        $this->Unit_cost = isset($_POST['Unit_cost']) ? $_POST['Unit_cost'] : '';
        $this->unit = isset($_POST['unit']) ? $_POST['unit'] : '';
        $this->quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 0;

        // Create a new row for the table and populate it with form data
        $newRow = "<tr><td>{$this->catalogue_No}</td><td>{$this->Item}</td><td>{$this->description}</td><td>{$this->quantity}</td>
        <td>{$this->unit}</td><td>{$this->price}</td><td>{$this->total_price}</td><td>{$this->converted_value}</td></tr>";

        // Echo the new row to send it back to the JavaScript success function
        echo $newRow;
    }
}

include('database_connection.php');
$grossPay = new calculateSuppliesBudget($conn);
$grossPay->display_table();
$grossPay->get_equipment_total();
