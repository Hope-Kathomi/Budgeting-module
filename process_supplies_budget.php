<?php
//session_save_path('C:\Users\hnyaga\Desktop\Software\budget app - 5\budget_app_sessions');
session_start();

class calculateSuppliesBudget {
    public $step;
    public $Item;
    public $conn;
    public $sub_equipments;
    public $price;
    public $description;
    public $quarter;
    public $quantity;
    public $Unit_cost;
    public $unit;
    public $amount;
    public $total_price;
    public $catalogue_No;
    public $exchange_rate;
    public $converted_value;
    
    function __construct($conn) {
        $this->conn = $conn;
        $this->get_unit_price();
    }
    
    function get_unit_price() {
        // Determine the item based on input fields
        if (isset($_POST['model']) && $_POST['model'] !== 'Other') {
            $this->Item = $_POST['Item'];
        } elseif (isset($_POST['model_input']) && !empty($_POST['model_input'])) {
            $this->Item = $_POST['model_input'];  
        } elseif (isset($_POST['Item_input']) && !empty($_POST['Item_input'])) {
            $this->Item = $_POST['Item_input'];
        } elseif (isset($_POST['Item']) && !empty($_POST['Item'])) {
            $this->Item = $_POST['Item'];
        } else {
            // Handle error if Item is not set
            echo "Item not provided.";
            return;
        }

        $this->quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 0;
        $this->exchange_rate = $_SESSION['exchange_rate'] ?? 1; // Default to 1 if not set

        // Query database if $this->Item is set
        if ($this->Item) {
            $sql_query = "SELECT price, Catalogue_No FROM supplies WHERE item = ?";
            $stmt = $this->conn->prepare($sql_query);

            if (!$stmt) {
                die("Prepare failed: (" . $this->conn->errno . ") " . $this->conn->error);
            }

            $stmt->bind_param("s", $this->Item);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $this->price = $row['price'];
                $this->catalogue_No = $row['Catalogue_No'];
                $this->total_price = $this->price * $this->quantity;
                $this->converted_value = $this->formatToTwoDecimalPlaces($this->total_price / $this->exchange_rate);
                $this->total_price = $this->formatToTwoDecimalPlaces($this->total_price);
            } else {
                $this->handleItemNotFound();
            }

            $stmt->close();
        } else {
            $this->handleItemNotFound();
        }
    }

    private function handleItemNotFound() {
        if (isset($_POST['unit_cost_other']) && !empty($_POST['unit_cost_other'])) {
            $this->price = $_POST['unit_cost_other'];
            $this->total_price = $this->price * $this->quantity;
            $this->converted_value = $this->formatToTwoDecimalPlaces($this->total_price / $this->exchange_rate);
            $this->total_price = $this->formatToTwoDecimalPlaces($this->total_price);
        } else {
            echo "unit_cost_other is not set or empty.";
        }
    }

    private function formatToTwoDecimalPlaces($value) {
        return number_format($value, 2, '.', ',');
    }

    function get_supplies_total(){
        if (isset($_POST['total']) && isset($_SESSION['valid'])) {
            $_SESSION['supplies_total'] = $_POST['total'];
            $_SESSION['supplies_total_converted_total'] = $_POST['finalConvertedTotal'];
            echo $_SESSION['supplies_total'];
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
        if (isset($_POST['Item_input']) && !empty($_POST['Item_input'])) {
            $this->Item = $_POST['Item_input'];
            $this->price = isset($_POST['unit_cost_other']) ? $_POST['unit_cost_other'] : 0;
            $this->total_price = $this->price * $this->quantity;
            $this->converted_value = $this->formatToTwoDecimalPlaces($this->total_price / $this->exchange_rate);
        } else {
            echo 'Item not set.';
            
        }

        // Set other attributes from POST data
        $this->description = isset($_POST['description']) ? $_POST['description'] : '';
        $this->quarter = isset($_POST['quarter']) ? $_POST['quarter'] : '';
        $this->Unit_cost = isset($_POST['Unit_cost']) ? $_POST['Unit_cost'] : '';
        $this->unit = isset($_POST['unit']) ? $_POST['unit'] : '';
        $this->quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 0;

        // Create and display a new row
        $newRow = "<tr><td>{$this->catalogue_No}</td><td>{$this->Item}</td><td>{$this->description}</td><td>{$this->quantity}</td>
        <td>{$this->unit}</td><td>{$this->price}</td><td>{$this->total_price}</td><td>{$this->converted_value}</td></tr>";
        echo $newRow;
    }
}

include('database_connection.php'); // Ensure $conn is correctly initialized
$grossPay = new calculateSuppliesBudget($conn);
$grossPay->display_table();
$grossPay->get_supplies_total();

?>
