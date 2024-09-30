<?php
//session_save_path('C:\Users\hnyaga\Desktop\Software\budget app - 5\budget_app_sessions');
session_start();

class calculateGrossPay {
    public $status;
    public $conn;
    public $description;
    public $allowance;
    public $period;
    public $subscriptions;
    public $number;
    public $role;
    public $amount;

    function __construct($status){
        $this->status = $status;
    }

    function calculate_amount() {
        // Example calculation for amount
        // Replace this with the actual logic for calculating the amount
        $this->amount = (($this->allowance + $this->subscriptions) * $this->period)*$this->number;
    }

    function display_table() {
        $this->description = $_POST['description']; // Assuming the form input name is 'Description_other'
        $this->role = $_POST['role']; // Assuming the form input name is 'role_other'
        $this->status = $_POST['status'];
        $this->allowance = $_POST['allowance']; // Assuming the form input name is 'Allowance_other'
        $this->period = $_POST['period'];
        $this->subscriptions = $_POST['subscriptions']; // Assuming the form input name is 'Subscriptions_other'
        $this->number = $_POST['number'];

        // Calculate the amount based on the allowance, subscriptions, and period
        $this->calculate_amount();

        // Create a new row for the table and populate it with form data
        $newRow = "<tr><td>$this->description</td><td>$this->role</td><td>$this->status</td><td>$this->number</td><td>$this->allowance</td><td>$this->subscriptions</td><td>$this->period</td><td>$this->amount</td></tr>";

        // Echo the new row to send it back to the JavaScript success function
        echo $newRow;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $grossPay = new calculateGrossPay($_POST['status']);
    $grossPay->display_table();
}
?>