<?php
//session_save_path('C:\Users\hnyaga\Desktop\Software\budget app - 5\budget_app_sessions');
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        // Include database connection
        include('database_connection.php');

        // Debugging: Dump the raw data
        //var_dump($_POST);

        // Check if Type_of_travel is set in $_POST using array_key_exists
        if (array_key_exists('Type_of_travel', $_POST)) {
            $Type_of_travel = trim($_POST['Type_of_travel']);
            
            // Instantiate calculateTravelPerdiem class
            $travelPerdiem = new calculateTravelPerdiem($conn, $Type_of_travel);
            $diem = $travelPerdiem->get_perdiem();
            $table = $travelPerdiem->display_table();
        } else {
            throw new Exception("Type_of_travel is not set in the form submission.");
        }
    } catch (Exception $e) {
        // Echo the actual error
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Form not submitted.";
}

class calculateTravelPerdiem{
    public $Per_diems_local_travel;
    public $Type_of_travel;
    public $location_visited;
    public $Location;
    public $per_diem;
    public $conn;
    public $country_visited;
    public $No_of_travellors;
    public $number_of_nights_out;
    public $number_of_trips;
    public $quater_of_visit;
    public $Air_road_fare;
    public $Taxi_expenses;
    public $total_per_diem;
    public $Salary_grade_of_travellor;
    public $exchange_rate;
    public $converted_value;
    public $KMR;
    public $travel_exchange_rate;
    

    function __construct($conn,$Type_of_travel){
        $this->Type_of_travel = $Type_of_travel;
        $this->conn = $conn;
        $this->exchange_rate = $_SESSION['exchange_rate'];
        
        //$this->get_perdiem();
    }
    
    function get_perdiem(){
        if (isset($_POST['Type_of_travel'])) {
            $this->Type_of_travel = $_POST['Type_of_travel'];
            //echo '<p>Type of travel: ' . $this->Type_of_travel . '</p>';
        
            if ($this->Type_of_travel == 'International') {
                //echo '<p>International travel selected</p>';
                $this->Location = $_POST['Location_visited'];
                $this->KMR = $_POST['Salary_grade_of_travellor'];
                $words = preg_split('/[\s_\-]+/', $this->KMR);
                //echo '<p>' . $words[1] . '</p>';
                $sql_query = "SELECT KMR$words[1] FROM Per_diems_international_travel WHERE COUNTRY ='$this->Location'";
                $result = $this->conn->query($sql_query);
                if ($result) {
                    $row = $result->fetch_assoc();
                    $this->per_diem = $row['KMR' . $words[1]];
                } else {
                    echo '<p>Error in query: ' . $this->conn->error . '</p>';
                }
        
                $this->Salary_grade_of_travellor = $_POST['Salary_grade_of_travellor'];
                $this->number_of_nights_out = $_POST['No_of_nights_out'];
                $this->Air_road_fare = $_POST['Air_road_fare'];
                $this->Taxi_expenses = $_POST['Taxi_expenses'];
                $this->No_of_travellors = $_POST['No_of_travellors'];
                $this->number_of_trips = $_POST['no_of_trips'];
                $this->quater_of_visit = $_POST['Quarter'];
                $this->travel_exchange_rate = $_POST['travel_exchange_rate'];
                $this->total_per_diem = (($this->per_diem * $this->No_of_travellors * $this->number_of_nights_out * $this->number_of_trips) +
                                        ($this->Air_road_fare * $this->No_of_travellors * $this->number_of_trips) +
                                        ($this->Taxi_expenses * $this->No_of_travellors * $this->number_of_trips))* $this->travel_exchange_rate;
                $this->converted_value = $this->total_per_diem / $this->exchange_rate;
                $this->converted_value =$this->formatToTwoDecimalPlaces($this->total_per_diem / $this->exchange_rate);
                $this->total_per_diem = $this->formatToTwoDecimalPlaces($this->total_per_diem);
                $_SESSION['travels_total']=$this->total_per_diem;

            } elseif ($this->Type_of_travel == 'Local') {
                //echo '<p>Local travel selected</p>';
                $this->Salary_grade_of_travellor = $_POST['Salary_grade_of_travellor'];
                //echo '<p>' . $this->Salary_grade_of_travellor . '</p>';
                
                
                $sql_query = "SELECT Per_diem_rate FROM Per_diems_local_travel WHERE KMR ='$this->Salary_grade_of_travellor'";
                $result = $this->conn->query($sql_query);

                if ($result) {
                    $row = $result->fetch_assoc();
                    $this->per_diem = $row['Per_diem_rate'];
                } else {
                    echo '<p>Error in query: ' . $this->conn->error . '</p>';
                }
        
                $this->Location = $_POST['Location_visited'];
                $this->number_of_nights_out = $_POST['No_of_nights_out'];
                $this->Air_road_fare = $_POST['Air_road_fare'];
                $this->Taxi_expenses = $_POST['Taxi_expenses'];
                $this->No_of_travellors = $_POST['No_of_travellors'];
                $this->number_of_trips = $_POST['no_of_trips'];
                $this->quater_of_visit = $_POST['Quarter'];
                $this->total_per_diem = ($this->per_diem * $this->No_of_travellors * $this->number_of_nights_out * $this->number_of_trips) +
                                        ($this->Air_road_fare * $this->No_of_travellors * $this->number_of_trips) +
                                        ($this->Taxi_expenses * $this->No_of_travellors * $this->number_of_trips);
                $this->converted_value = $this->total_per_diem / $this->exchange_rate;
                $this->converted_value =$this->formatToTwoDecimalPlaces($this->total_per_diem / $this->exchange_rate);
                $this->total_per_diem = $this->formatToTwoDecimalPlaces($this->total_per_diem);
                //$_SESSION['travels_total']=$this->total_per_diem;
            }
        } else {
            echo '<p>Type_of_travel is not set</p>';
        }
    }
    private function formatToTwoDecimalPlaces($value) {
        return number_format($value, 2, '.', ',');
    }

    function display_table(){
        $number_of_people_travelling = $_POST['No_of_travellors'];
        //$role = $_POST['role'];
        //$status = $_POST['status'];
        //$this->number = $_POST['number'];
        //$this->period=$_POST['period'];
        
        $this->location_visited = $_POST['Location_visited'];
        //echo '<p>'.$nairobi_per_diems.'</p>';
        if($this->location_visited ==='Nairobi'){
            $nairobi_per_diems = $_POST['nairobi_per_diems'];
            $this->total_per_diem = ($nairobi_per_diems * $this->No_of_travellors * $this->number_of_nights_out * $this->number_of_trips) +
            ($this->Air_road_fare * $this->No_of_travellors * $this->number_of_trips) +
            ($this->Taxi_expenses * $this->No_of_travellors * $this->number_of_trips);

            $newRow = "<tr><td>$this->Salary_grade_of_travellor</td><td>$this->Location</td><td>$nairobi_per_diems</td>
            <td>$number_of_people_travelling</td><td>$this->number_of_nights_out</td><td>$this->number_of_trips</td>
            <td>$this->quater_of_visit</td><td>$this->total_per_diem</td><td>$this->converted_value</td></tr>";            
            echo $newRow;
        }else{
            // Create a new row for the table and populate it with form data
            $newRow = "<tr><td>$this->Salary_grade_of_travellor</td><td>$this->Location</td><td>$this->per_diem</td>
            <td>$number_of_people_travelling</td><td>$this->number_of_nights_out</td><td>$this->number_of_trips</td>
            <td>$this->quater_of_visit</td><td>$this->total_per_diem</td><td>$this->converted_value</td></tr>";            
            echo $newRow;
        }
    }
}
?>