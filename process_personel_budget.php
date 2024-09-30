<?php
if (session_status() == PHP_SESSION_NONE) {
    //session_save_path('C:\Users\hnyaga\Desktop\Software\budget app - 5\budget_app_sessions');
    session_start();
}
include('database_connection.php'); // Ensure this is included at the top

class calculateGrossPay {
    public $status;
    public $step;
    public $gratuity;
    public $conn;
    public $designation;
    public $gross_salary;
    public $period;
    public $fte;
    public $fte_amount;
    public $amount;
    public $number;
    public $role;
    public $Subscriptions_other;
    public $exchange_rate;
    public $converted_value;

    function __construct($conn, $status) {
        $this->conn = $conn;
        $this->status = $status;

        $this->get_gross_pay();
    }

    function get_gross_pay() {
        if (!isset($_POST['designation'], $_POST['status'], $_POST['period'], $_POST['fte'], $_POST['number'])) {
            echo $_POST['status'];
            echo '<p>Required parameters are missing</p>';
            return;
        }

        $this->designation = $_POST['designation'];
        $this->period = $_POST['period'];
        $this->fte = $_POST['fte'];
        $this->number = $_POST['number'];
        $this->exchange_rate = $_SESSION['exchange_rate'];
        echo $this->exchange_rate;

        if (!empty($_POST['step'])) {
            $this->step = $_POST['step'];
        } else {
            echo 'Step not set';
            return;
        }

        if ($this->status === 'pnp') {
            echo $this->status;
            $sql_query = "SELECT Gross_monthly_pay_and_benefits_pnp FROM KEMRI_pay_structure WHERE Designation = ? AND Step = ?";
        } elseif ($this->status === 'contract') {
            echo $this->status;
            $sql_query = "SELECT Gross_monthly_pay_and_benefits_contract FROM KEMRI_pay_structure WHERE Designation = ? AND Step = ?";
        } //elseif ($this->status === 'other') {
            //echo $this->status;
            //$role_other = $_POST['role_other'];
            //$this->role =$role_other;
            //$period_other = $_POST['period_other'];
            //$Subscriptions_other = $_POST['Subscriptions_other'];
            //$description = $_POST['description'];
            //$number_other = $_POST['number_other'];
            //$allowance_other=$_POST['allowance_other'];
 
            //return;
        //} 
        else {
            echo 'Invalid status';
            return;
        }

        // Use prepared statements to prevent SQL injection
        $stmt = $this->conn->prepare($sql_query);
        $stmt->bind_param('ss', $this->designation, $this->step);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            if ($this->status === 'pnp') {
                $this->gross_salary = $row['Gross_monthly_pay_and_benefits_pnp'];
            } else {
                $this->gross_salary = $row['Gross_monthly_pay_and_benefits_contract'];
            }
            var_dump($this->gross_salary);
            $this->amount = $this->gross_salary + (($this->gross_salary * ($this->fte / 100)) * $this->period * $this->number);
            $this->converted_value =$this->formatToTwoDecimalPlaces($this->amount / $this->exchange_rate);
            $this->amount = $this->formatToTwoDecimalPlaces($this->amount);
            //$_SESSION['personnels_total'] = $this->amount;
            $_SESSION['personnel_total_converted_'] = $this->converted_value;
        } elseif ($this->status === 'other'){
            echo 'No data found for the given designation and step';
        }
        $stmt->close();
    }
    private function formatToTwoDecimalPlaces($value) {
        return number_format($value, 2, '.', ',');
    }
    
    //function get_personnel_total(){
    //    if (isset($_POST['total']) && isset($_SESSION['valid'])) {
    //       // $this->user_pno = $_SESSION['valid'];
    //       //$converted_total = $_POST['finalConvertedTotal'];
    //        echo $_POST['total'];
    //        $_SESSION['personnels_total'] = $_POST['total'];
    //        $_SESSION['personnels_converted_total'] = $_POST['finalConvertedTotal'];
    //        echo "Session variable 'personnel_total' set successfully.";
    //    } else {
    //        if (!isset($_SESSION['valid'])) {
    //            echo "Session variable 'valid' is not set.";
    //        }
    //        if (!isset($_POST['total'])) {
    //            echo "Total value not provided.";
    //        }
    //    }
    //}

    function display_table() {
        $role = $_POST['role'];
        $status = $_POST['status'];       

        if($_POST['status'] === 'pnp' || $_POST['status'] === 'contract'){
            // Create a new row for the table and populate it with form data
            $newRow = "<tr><td>{$this->designation}</td><td>{$role}</td><td>{$status}</td><td>{$this->number}</td><td>{$this->gross_salary}</td>
            <td>{$this->fte}</td><td>N/A</td><td>{$this->period}</td><td>{$this->amount}</td>
            <td>{$this->converted_value}</td></tr>";
            // Echo the new row to send it back to the JavaScript success function
            echo $newRow;

            return [$this->designation, $role, $status, $this->number, $this->gross_salary, $this->fte, 'N/A', $this->period, 
            $this->amount, $this->converted_value ];
        }else{
            //echo '<pre>';
            //print_r($_POST);
            //echo '</pre>';
            $Description_other = $_POST['Description_other'];
            $role_other = $_POST['role_other'];
            $allowance_other = $_POST['allowance_other'];
            $Subscriptions_other = $_POST['Subscriptions_other'];
            $number_other = $_POST['number_other'];
            $period_other = $_POST['period_other'];

            $this->exchange_rate = $_SESSION['exchange_rate'];
            $amount_other = $allowance_other * $number_other * $period_other;
            $this->converted_value = $this->formatToTwoDecimalPlaces($amount_other / $this->exchange_rate);

            $newRow = "<tr><td>{$Description_other}</td><td>{$role_other}</td><td>{$status}</td><td>{$number_other}</td><td>{$allowance_other}</td>
            <td>N/A</td><td>{$Subscriptions_other}</td><td>{$period_other}</td><td>{$amount_other}</td><td>{$this->converted_value}</td></tr>";
            //Echo the new row to send it back to the JavaScript success function
            echo $newRow;

            return [$Description_other, $role_other, $status, $number_other, $allowance_other, 'N/A', $Subscriptions_other, $period_other, 
            $amount_other, $this->converted_value ];
        }
    }
    
}

$grossPay = new calculateGrossPay($conn, $_POST['status']);
$data = $grossPay->display_table();
var_dump($data); 
