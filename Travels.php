<?php
//session_save_path('C:\Users\hnyaga\Desktop\Software\budget app - 5\budget_app_sessions');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travels budget</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body >
    <div class="nav_panel">
        <div class="page_title_div">Travels budget</div>
        <div class="log_out_div">
            <!--<p><?php echo $_SESSION['valid'];?></p>-->
            <a href="log_out.php">Logout</a>
        </div>
    </div>
    
    <div class="containers"> 
        <div class="left_nav_panel">
            <p>Budget module</p>
            <a href="Personnel.php" class="left_nav_href"> 
                <img src="Images/person_blue.png" alt="Description of image" class="icons">
                Personnel
            </a>
            <a href="equipments.php" class="left_nav_href">
                <img src="Images/equipments_blue.png" alt="Description of image" class="icons">
                Equipments
            </a>
            <a href="Supplies.php" class="left_nav_href">
                <img src="Images/supplies_blue.png" alt="Description of image" class="icons">
                Supplies
            </a>
            <a href="Travels.php" class="left_nav_href">
                <img src="Images/travels_blue.png" alt="Description of image" class="icons">
                Travels
            </a>
            <a href="Contractuals.php" class="left_nav_href">
                <img src="Images/contractuals_blue.png" alt="Description of image" class="icons">
                Contractuals
            </a>
            <a href="Others.php" class="left_nav_href">
                <img src="Images/others_blue.png" alt="Description of image" class="icons">
                Others
            </a>
            <a href="Indirect_cost.php" class="left_nav_href">
                <img src="Images/Indirect cost.png" alt="Description of image" class="icons">
                Indirect cost
            </a>
            <a href="summary.php" class="left_nav_href">
                <img src="Images/Summary.png" alt="Description of image" class="icons">
                Summary
            </a>
        </div>
        <div id="input_form">
            <form class="form-container" method="POST" action="process_travels_budget.php">
                <div class="form-column">
                    <div class="form-group">
                        <label for="Travellor salary grade">Travellor salary grade</label>
                        <select name="Salary_grade_of_travellor" id="Salary_grade_of_travellor">
                            <option value ="KMR 1"> KMR 1 </option>
                            <option value ="KMR 2"> KMR 2 </option>
                            <option value ="KMR 3"> KMR 3 </option>
                            <option value ="KMR 4"> KMR 4 </option>
                            <option value ="KMR 5"> KMR 5 </option>
                            <option value ="KMR 6"> KMR 6 </option>
                            <option value ="KMR 7"> KMR 7 </option>
                            <option value ="KMR 8"> KMR 8 </option>
                            <option value ="KMR 9"> KMR 9 </option>
                            <option value ="KMR 10"> KMR 10 </option>
                            <option value ="KMR 11"> KMR 11 </option>
                            <option value ="KMR 12"> KMR 12 </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="type of travel">Type of travel:</label>
                        <select name = "Type_of_travel" id="Type_of_travel">
                            <option value="Local" name='Local'>Local</option>
                            <option value="International" name = 'International'>International</option> 
                        </select>                   
                    </div>                                  
                    <div class="form-group">
                        <label for="Location visited"> Location visited:</label>
                        <select name="location_visited" id="location_visited">
                            <!-- Options will be dynamically populated here -->
                        </select>   
                    </div>
                    <div class = "form-group" id = "per_diem">
                        <!-- input form will be dynamically displayed here -->
                    </div>
                    <div class = "form-group" id = "exchange_rate">
                        <!-- input form will be dynamically displayed here -->
                    </div>
                </div>
                <div class="form-column">
                    
                    <div class="form-group">
                        <label for="Number of nights out">No. of nights out:</label>
                        <input type="number" name= "No_of_nights_out" id="No_of_nights_out">  
                    </div>
                
                    <div class="form-group">
                        <label for="Air/road fare">Air/road fare:</label>
                        <input type="number" name = "Air_road_fare" id="Air_road_fare">
                    </div>               
                    <div class="form-group">
                        <label for="Taxi expenses">Taxi expenses</label>
                        <input type="number" name="Taxi_expenses" id="Taxi_expenses" required>
                    </div>
                </div>
                <div class="form-column">
                    <div class="form-group">
                        <label for="Number of persons travelling" >No of persons travelling:</label>
                        <input type="number" id = 'No_of_travellors'name="No_of_travellors" required>
                    </div>
                
                    <div class="form-group">
                        <label for="Number of trips">Number of trips:</label>
                        <input type="number" id = 'no_of_trips' name = "no_of_trips" required>
                   
                    </div>
                    <div class="form-group">
                        <label for="Nature of travel">Nature of travel:</label>
                        <input type="text" name="Nature_of_travel" id="Nature_of_travel">
                    </div>
                </div>
                <div class="form-column">
                    <div class="form-group">
                        <label for="Quarter"> Quarter of travel:</label>
                        <input type="number" name="Quarter" id="Quarter">
                    </div>
                </div> 
            </form>   
        </div>
        <div class="form-group">
            <button type="button" id="displayDataBtn">Add</button>
        </div>
        <div class="view_table">
            <table class="dataTable">
                <thead>
                    <tr>
                        <th>KMR of travellor</th>
                        <th>Area visited</th>
                        <th>Per diem </th>
                        <th>No. of people travelling</th>
                        <th>No. of nights out</th>
                        <th>No of trips</th>
                        <th>Quarter of visit</th>
                        <th>Amount (ksh)</th>
                        <th id="amount-header">Amount (USD)</th>
                    </tr>
                </thead>
                <tbody id='tableBody'>
                <!-- Table rows will be dynamically added -->
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="7">Total</td>
                     
                        <td id="sum">sum</td>
                        <td id="sum_other">sum other</td>
                    </tr>
                </tfoot>
            </table>
            <div class = 'bottom_buttons'>
                <div><button id="submitBtn">Submit</button></div>
                <div class="next_button"><a href="contractuals.php">Next</a></div>
            </div>
        </div>
        
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            
            // Display initial local locations
            displayLocal();

            $('#Type_of_travel').change(function() {
                var selected_option = $(this).val();
                var form_container = $('#exchange_rate');

                if (selected_option === 'International') {
                    form_container.show();
                    form_container.html(`
                        <div class='form-group' id='foreign_travel_exchange_rate'>
                            <label for='exchange_rate'>Exchange rate</label>
                            <input type='number' name='travel_exchange_rate' id='travel_exchange_rate'>
                        </div>
                    `);
                } else {
                    form_container.hide();
                
                }
            });

            $('#location_visited').change(function() {
                var selected_option = $(this).val();
                var form_container = $('#per_diem');

                if (selected_option === 'Nairobi') {
                    form_container.show();
                    form_container.html(`
                        <div class='form-group' id='nairobi_per_diems_div'>
                            <label for='per_diems'>Per diem</label>
                            <input type='number' name='nairobi_per_diems' id='nairobi_per_diems'>
                        </div>
                    `);
                } else {
                    form_container.hide();
                    
                }
            });

            $("#displayDataBtn").click(function() {
                // Get form values
                var Salary_grade_of_travellor = $("#Salary_grade_of_travellor").val();
                var Type_of_travel = $("#Type_of_travel").val();
                var Location_visited = $('#location_visited').val();
                var per_diems = $("#per_diems").val();
                var nairobi_per_diems = $('#nairobi_per_diems').val();
                var no_of_trips = $("#no_of_trips").val();
                var No_of_travellors = $("#No_of_travellors").val();
                var No_of_nights_out = $("#No_of_nights_out").val();
                var Air_road_fare = $("#Air_road_fare").val();
                var Taxi_expenses = $("#Taxi_expenses").val();
                var quantity = $("#no_of_trips").val();
                var Quarter = $("#Quarter").val();
                var funders_exchange_rate = $('#funders_exchange_rate').val();
                var travel_exchange_rate = $('#travel_exchange_rate').val();

                console.log('The type of travel is: ', Type_of_travel);
                
                // Send form data to PHP script using AJAX
                $.ajax({
                    type: "post",
                    url: "process_travels_budget.php", // Your PHP script that processes the form data
                    data: {
                        Salary_grade_of_travellor: Salary_grade_of_travellor,
                        no_of_trips: no_of_trips,
                        Type_of_travel: Type_of_travel,
                        Location_visited: Location_visited,
                        nairobi_per_diems: nairobi_per_diems,
                        per_diems: per_diems,
                        No_of_travellors: No_of_travellors,
                        No_of_nights_out: No_of_nights_out,
                        Air_road_fare: Air_road_fare,
                        Taxi_expenses: Taxi_expenses,
                        quantity: quantity,
                        Quarter: Quarter,
                        funders_exchange_rate: funders_exchange_rate,
                        travel_exchange_rate: travel_exchange_rate
                    },
                    success: function(response) {
                        // Append the received data to the table body
                        $("#tableBody").append(response);
                        updateTotalAmount();
                        updateTotalConvertedAmount();

                        console.log("Final Total:", finalTotal);

                        var tableData = [];
                        $('#tableBody tr').each(function() {
                            var rowData = {};
                            $(this).find('td').each(function(index, cell) {
                                var headerText = $('#dataTable thead tr th:eq(' + index + ')').text();
                                rowData[headerText] = $(cell).text();
                            });
                            tableData.push(rowData);
                        });
                        console.log(tableData);

                        // Clear form inputs
                        //$("#Salary_grade_of_travellor").val('');
                        //$("#Type_of_travel").val("");
                        //$("#location_visited").val("");
                        $("#per_diems").val("");
                        $("#No_of_travellors").val("");
                        $("#No_of_nights_out").val("");
                        $("#quantity").val("");
                        $("#Quarter").val("");
                        $("#Air_road_fare").val("");
                        $("#no_of_trips").val("");
                        $("#Taxi_expenses").val("");
                        $("#Nature_of_travel").val("");
                    },
                    error: function(xhr, status, error) {
                        // Handle AJAX error
                        console.error('AJAX Error:', error);
                    }
                });
            });

            var finalTotal = 0;

            function updateTotalAmount() {
                var total = 0;
                // Loop through each row in the table body
                $('.dataTable tbody tr').each(function() {
                    // Get the value of the "amount" column for the current row
                    var amountStr = $(this).find('td:eq(7)').text();
                    // Remove commas from the string
                    var amountCleaned = amountStr.replace(/,/g, '');
                    // Parse the cleaned string as a float
                    var amount = parseFloat(amountCleaned);

                    // Add the amount to the total
                    if (!isNaN(amount)) { // Ensure the value is a valid number
                        total += amount;
                    }
                });
                // Format the total with comma separators and two decimal places
                var formattedTotal = total.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                // Update the total amount in the footer
                $('#sum').text(formattedTotal); // Display total with 2 decimal places
                finalTotal = formattedTotal;
            }

            var finalConvertedTotal = 0;

            function updateTotalConvertedAmount() {
                var total = 0;

                // Loop through each row in the table body
                $('.dataTable tbody tr').each(function() {
                    // Get the value of the "amount" column for the current row
                    var amountStr = $(this).find('td:eq(8)').text();
                    // Remove commas from the string
                    var amountCleaned = amountStr.replace(/,/g, '');
                    // Parse the cleaned string as a float
                    var amount = parseFloat(amountCleaned);

                    // Add the amount to the total
                    if (!isNaN(amount)) { // Ensure the value is a valid number
                        total += amount;
                    }
                });

                // Format the total with comma separators and two decimal places
                var formattedTotal = total.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');

                // Update the total amount in the footer
                $('#sum_other').text(formattedTotal); // Display formatted total

                finalConvertedTotal = formattedTotal;
            }

            function storeTableContentInSession() {
                var tableContent = $('.view_table').html(); // Get HTML content of tbody
                $.ajax({
                    type: "POST",
                    url: "store_travels_table.php", // Path to your PHP script
                    data: { tableContent: tableContent },
                    success: function(response) {
                        console.log(response); // Log server response
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error);
                    }
                });
            }

            // Insert total in database
            $("#submitBtn").click(function() {
                storeTableContentInSession();

                // Calculate total amount
                $.ajax({
                    type: "POST",
                    url: "process_travels_total.php", // Path to your PHP script
                    data: { total: finalTotal, Type_of_travel: $("#Type_of_travel").val(), finalConvertedTotal: finalConvertedTotal },
                    success: function(response) {
                        console.log(response); // Log server response
                        alert("Travels budget saved.");
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error);
                        alert("Error: Unable to set session variable.");
                    }
                });
            });

            $('#Type_of_travel').change(function() {
                var selection = $(this).val();
                console.log('Selected option:', selection);
                $('#location_visited').empty();

                if (selection === 'International') {
                    $('#location_visited').append('<option value="Afghanistan" id="Africa">Afghanistan</option>');
                    $('#location_visited').append('<option value="Albania" id="Albania">Albania</option>');
                    $('#location_visited').append('<option value="Algeria" id="Algeria">Algeria</option>');
                    $('#location_visited').append('<option value="Angola" id="Angola">Angola</option>');
                    $('#location_visited').append('<option value="Antigua &Barbuda" id="Antigua &Barbuda">Antigua &Barbuda</option>');

                    $('#location_visited').append('<option value="Argentina" id="Argentina">Argentina</option>');
                    $('#location_visited').append('<option value="Armenia" id="Armenia">Armenia</option>');
                    $('#location_visited').append('<option value="Aruba" id="Aruba">Aruba</option>');
                    $('#location_visited').append('<option value="Australia" id="Australia">Australia</option>');
                    $('#location_visited').append('<option value="Austria" id="Austria">Austria</option>');

                    $('#location_visited').append('<option value="Azerbaijan" id="Azerbaijan">Azerbaijan</option>');
                    $('#location_visited').append('<option value="Bahamas" id="Bahamas">Bahamas</option>');
                    $('#location_visited').append('<option value="Bahrain" id="Bahrain">Bahrain</option>');
                    $('#location_visited').append('<option value="Bangladesh" id="Bangladesh">Bangladesh</option>');
                    $('#location_visited').append('<option value="Barbados" id="Barbados">Barbados</option>');

                    $('#location_visited').append('<option value="Belarus" id="Belarus">Belarus</option>');
                    $('#location_visited').append('<option value="Belgium" id="Belgium">Belgium</option>');
                    $('#location_visited').append('<option value="Belize" id="Belize">Belize</option>');
                    $('#location_visited').append('<option value="Benin" id="Benin">Benin</option>');
                    $('#location_visited').append('<option value="Bermuda" id="Bermuda">Bermuda</option>');

                    $('#location_visited').append('<option value="Bhutan" id="Bhutan">Bhutan</option>');
                    $('#location_visited').append('<option value="Bolivia" id="Bolivia">Bolivia</option>');
                    $('#location_visited').append('<option value="Bosnia&Herzegovina" id="Bosnia&Herzegovina">Bosnia&Herzegovina</option>');
                    $('#location_visited').append('<option value="Botswana" id="Botswana">Botswana</option>');
                    $('#location_visited').append('<option value="Brazil" id="Brazil">Brazil</option>');

                    $('#location_visited').append('<option value="Brunei" id="Brunei">Brunei</option>');
                    $('#location_visited').append('<option value="Bulgaria" id="Bulgaria">Bulgaria</option>');
                    $('#location_visited').append('<option value="Burkina Faso" id="Burkina Faso">Burkina Faso</option>');
                    $('#location_visited').append('<option value="Burundi" id="Burundi">Burundi</option>');
                    $('#location_visited').append('<option value="Cambodia" id="Cambodia">Cambodia</option>');

                    $('#location_visited').append('<option value="Cameroon" id="Cameroon">Cameroon</option>');
                    $('#location_visited').append('<option value="Canada" id="Canada">Canada</option>');
                    $('#location_visited').append('<option value="Cape Verde" id="Cape Verde">Cape Verde</option>');
                    $('#location_visited').append('<option value="Central African Republic" id="Central African Republic">Central African Republic</option>');
                    $('#location_visited').append('<option value="Chad" id="Chad">Chad</option>');

                    $('#location_visited').append('<option value="Chile" id="Chile">Chile</option>');
                    $('#location_visited').append('<option value="China" id="China">China</option>');
                    $('#location_visited').append('<option value="Colombia" id="Colombia">Colombia</option>');
                    $('#location_visited').append('<option value="Comoros" id="Comoros">Comoros</option>');
                    $('#location_visited').append('<option value="Congo" id="Congo">Congo</option>');

                    $('#location_visited').append('<option value="Costa Rica" id="Costa Rica">Costa Rica</option>');
                    $('#location_visited').append('<option value="Cote d\'Ivoire" id="Cote d\'Ivoire">Cote d\'Ivoire</option>');
                    $('#location_visited').append('<option value="Croatia" id="Croatia">Croatia</option>');
                    $('#location_visited').append('<option value="Cuba" id="Cuba">Cuba</option>');
                    $('#location_visited').append('<option value="Cyprus" id="Cyprus">Cyprus</option>');

                    $('#location_visited').append('<option value="Czech Republic" id="Czech Republic">Czech Republic</option>');
                    $('#location_visited').append('<option value="Denmarck" id="Denmarck">Denmarck</option>');
                    $('#location_visited').append('<option value="Djibouti" id="Djibouti">Djibouti</option>');
                    $('#location_visited').append('<option value="Dominica" id="Dominica">Dominica</option>');
                    $('#location_visited').append('<option value="Dominican Republic" id="Dominican Republic">Dominican Republic</option>');

                    $('#location_visited').append('<option value="DRC Congo" id="DRC Congo">DRC Congo</option>');
                    $('#location_visited').append('<option value="Ecuador" id="Ecuador">Ecuador</option>');
                    $('#location_visited').append('<option value="Egypt" id="Egypt">Egypt</option>');
                    $('#location_visited').append('<option value="El Salvador" id="El Salvador">El Salvador</option>');
                    $('#location_visited').append('<option value="Equatorial Guinea" id="Equatorial Guinea">Equatorial Guinea</option>');

                    $('#location_visited').append('<option value="Eritrea" id="Eritrea">Eritrea</option>');
                    $('#location_visited').append('<option value="Estonia" id="Estonia">Estonia</option>');
                    $('#location_visited').append('<option value="Ethiopia" id="Ethiopia">Ethiopia</option>');
                    $('#location_visited').append('<option value="Fiji" id="Fiji">Fiji</option>');
                    $('#location_visited').append('<option value="Finland" id="Finland">Finland</option>');

                    $('#location_visited').append('<option value="France" id="France">France</option>');
                    $('#location_visited').append('<option value="French Guiana" id="French Guiana">French Guiana</option>');
                    $('#location_visited').append('<option value="Gabon" id="Gabon">Gabon</option>');
                    $('#location_visited').append('<option value="Gambia" id="Gambia">Gambia</option>');
                    $('#location_visited').append('<option value="Georgia" id="Georgia">Georgia</option>');

                    $('#location_visited').append('<option value="Germany" id="Germany">Germany</option>');
                    $('#location_visited').append('<option value="Ghana" id="Ghana">Ghana</option>');
                    $('#location_visited').append('<option value="Greece" id="Greece">Greece</option>');
                    $('#location_visited').append('<option value="Grenada" id="Grenada">Grenada</option>');
                    $('#location_visited').append('<option value="Guadeloupe" id="Guadeloupe">Guadeloupe</option>');

                    $('#location_visited').append('<option value="Guatemala" id="Guatemala">Guatemala</option>');
                    $('#location_visited').append('<option value="Guinea" id="Guinea">Guinea</option>');
                    $('#location_visited').append('<option value="Guinea Bissau" id="Guinea Bissau">Guinea Bissau</option>');
                    $('#location_visited').append('<option value="Guyana" id="Guyana">Guyana</option>');
                    $('#location_visited').append('<option value="Haiti" id="Haiti">Haiti</option>');

                    $('#location_visited').append('<option value="Honduras" id="Honduras">Honduras</option>');
                    $('#location_visited').append('<option value="Hungary" id="Hungary">Hungary</option>');
                    $('#location_visited').append('<option value="Iceland" id="Iceland">Iceland</option>');
                    $('#location_visited').append('<option value="India" id="India">India</option>');
                    $('#location_visited').append('<option value="Indonesia" id="Indonesia">Indonesia</option>');

                    $('#location_visited').append('<option value="Iran" id="Iran">Iran</option>');
                    $('#location_visited').append('<option value="Iraq" id="Iraq">Iraq</option>');
                    $('#location_visited').append('<option value="Ireland" id="Ireland">Ireland</option>');
                    $('#location_visited').append('<option value="Israel" id="Israel">Israel</option>');
                    $('#location_visited').append('<option value="Italy" id="Italy">Italy</option>');

                    $('#location_visited').append('<option value="Jamaica" id="Jamaica">Jamaica</option>');
                    $('#location_visited').append('<option value="Japan" id="Japan">Japan</option>');
                    $('#location_visited').append('<option value="Jordan" id="Jordan">Jordan</option>');
                    $('#location_visited').append('<option value="Kazakhstan" id="Kazakhstan">Kazakhstan</option>');
                    $('#location_visited').append('<option value="Kiribati" id="Kiribati">Kiribati</option>');

                    $('#location_visited').append('<option value="Korea" id="Korea">Korea</option>');
                    $('#location_visited').append('<option value="Kosovo" id="Kosovo">Kosovo</option>');
                    $('#location_visited').append('<option value="Kuwait" id="Kuwait">Kuwait</option>');
                    $('#location_visited').append('<option value="Kyrgyzstan" id="Kyrgyzstan">Kyrgyzstan</option>');
                    $('#location_visited').append('<option value="Laos" id="Laos">Laos</option>');

                    $('#location_visited').append('<option value="Latvia" id="Latvia">Latvia</option>');
                    $('#location_visited').append('<option value="Lebanon" id="Lebanon">Lebanon</option>');
                    $('#location_visited').append('<option value="Lesotho" id="Lesotho">Lesotho</option>');
                    $('#location_visited').append('<option value="Liberia" id="Liberia">Liberia</option>');
                    $('#location_visited').append('<option value="Libya" id="Libya">Libya</option>');

                    $('#location_visited').append('<option value="Liechtenstein" id="Liechtenstein">Liechtenstein</option>');
                    $('#location_visited').append('<option value="Lithuania" id="Lithuania">Lithuania</option>');
                    $('#location_visited').append('<option value="Luxembourg" id="Luxembourg">Luxembourg</option>');
                    $('#location_visited').append('<option value="Macedonia" id="Macedonia">Macedonia</option>');
                    $('#location_visited').append('<option value="Madagascar" id="Madagascar">Madagascar</option>');

                    $('#location_visited').append('<option value="Malawi" id="Malawi">Malawi</option>');
                    $('#location_visited').append('<option value="Malaysia" id="Malaysia">Malaysia</option>');
                    $('#location_visited').append('<option value="Maldives" id="Maldives">Maldives</option>');
                    $('#location_visited').append('<option value="Mali" id="Mali">Mali</option>');
                    $('#location_visited').append('<option value="Malta" id="Malta">Malta</option>');

                    $('#location_visited').append('<option value="Marshall Islands" id="Marshall Islands">Marshall Islands</option>');
                    $('#location_visited').append('<option value="Mauritania" id="Mauritania">Mauritania</option>');
                    $('#location_visited').append('<option value="Mauritius" id="Mauritius">Mauritius</option>');
                    $('#location_visited').append('<option value="Mexico" id="Mexico">Mexico</option>');
                    $('#location_visited').append('<option value="Micronesia" id="Micronesia">Micronesia</option>');

                    $('#location_visited').append('<option value="Moldova" id="Moldova">Moldova</option>');
                    $('#location_visited').append('<option value="Monaco" id="Monaco">Monaco</option>');
                    $('#location_visited').append('<option value="Mongolia" id="Mongolia">Mongolia</option>');
                    $('#location_visited').append('<option value="Montenegro" id="Montenegro">Montenegro</option>');
                    $('#location_visited').append('<option value="Morocco" id="Morocco">Morocco</option>');

                    $('#location_visited').append('<option value="Mozambique" id="Mozambique">Mozambique</option>');
                    $('#location_visited').append('<option value="Myanmar" id="Myanmar">Myanmar</option>');
                    $('#location_visited').append('<option value="Namibia" id="Namibia">Namibia</option>');
                    $('#location_visited').append('<option value="Nauru" id="Nauru">Nauru</option>');
                    $('#location_visited').append('<option value="Nepal" id="Nepal">Nepal</option>');

                    $('#location_visited').append('<option value="Netherlands" id="Netherlands">Netherlands</option>');
                    $('#location_visited').append('<option value="New zealand" id="New zealand">New zealand</option>');
                    $('#location_visited').append('<option value="Nicaragua" id="Nicaragua">Nicaragua</option>');
                    $('#location_visited').append('<option value="Niger" id="Niger">Niger</option>');
                    $('#location_visited').append('<option value="Nigeria" id="Nigeria">Nigeria</option>');

                    $('#location_visited').append('<option value="North Korea" id="North Korea">North Korea</option>');
                    $('#location_visited').append('<option value="Norway" id="Norway">Norway</option>');
                    $('#location_visited').append('<option value="Oman" id="Oman">Oman</option>');
                    $('#location_visited').append('<option value="Pakistan" id="Pakistan">Pakistan</option>');
                    $('#location_visited').append('<option value="Palau" id="Palau">Palau</option>');

                    $('#location_visited').append('<option value="Panama" id="Panama">Panama</option>');
                    $('#location_visited').append('<option value="Papua New Guinea" id="Papua New Guinea">Papua New Guinea</option>');
                    $('#location_visited').append('<option value="Paraguay" id="Paraguay">Paraguay</option>');
                    $('#location_visited').append('<option value="Peru" id="Peru">Peru</option>');
                    $('#location_visited').append('<option value="Philippines" id="Philippines">Philippines</option>');

                    $('#location_visited').append('<option value="Poland" id="Poland">Poland</option>');
                    $('#location_visited').append('<option value="Portugal" id="Portugal">Portugal</option>');
                    $('#location_visited').append('<option value="Puerto Rico" id="Puerto Rico">Puerto Rico</option>');
                    $('#location_visited').append('<option value="Qatar" id="Qatar">Qatar</option>');
                    $('#location_visited').append('<option value="Reunion" id="Reunion">Reunion</option>');

                    $('#location_visited').append('<option value="Romania" id="Romania">Romania</option>');
                    $('#location_visited').append('<option value="Russia" id="Russia">Russia</option>');
                    $('#location_visited').append('<option value="Rwanda" id="Rwanda">Rwanda</option>');
                    $('#location_visited').append('<option value="Samoa" id="Samoa">Samoa</option>');
                    $('#location_visited').append('<option value="San Marino" id="San Marino">San Marino</option>');

                    $('#location_visited').append('<option value="Sao Tome &Principe" id="Sao Tome &Principe">Sao Tome &Principe</option>');
                    $('#location_visited').append('<option value="Saudi Arabia" id="Saudi Arabia">Saudi Arabia</option>');
                    $('#location_visited').append('<option value="Senegal" id="Senegal">Senegal</option>');
                    $('#location_visited').append('<option value="Serbia" id="Serbia">Serbia</option>');
                    $('#location_visited').append('<option value="Seychelles" id="Seychelles">Seychelles</option>');

                    $('#location_visited').append('<option value="Sierra leone" id="Sierra leone">Sierra leone</option>');
                    $('#location_visited').append('<option value="Singapore" id="Singapore">Singapore</option>');
                    $('#location_visited').append('<option value="Slovakia" id="Slovakia">Slovakia</option>');
                    $('#location_visited').append('<option value="Slovenia" id="Slovenia">Slovenia</option>');
                    $('#location_visited').append('<option value="Solomon Islands" id="Solomon Islands">Solomon Islands</option>');

                    $('#location_visited').append('<option value="Somalia" id="Somalia">Somalia</option>');
                    $('#location_visited').append('<option value="South Africa" id="South Africa">South Africa</option>');
                    $('#location_visited').append('<option value="South Sudan" id="South Sudan">South Sudan</option>');
                    $('#location_visited').append('<option value="Spain" id="Spain">Spain</option>');
                    $('#location_visited').append('<option value="Sri Lanka" id="Sri Lanka">Sri Lanka</option>');

                    $('#location_visited').append('<option value="St. Kitts and Nevis" id="St. Kitts and Nevis">St. Kitts and Nevis</option>');
                    $('#location_visited').append('<option value="St Lucia" id="St Lucia">St Lucia</option>');
                    $('#location_visited').append('<option value="St Vincent and Grenadines" id="St Vincent and Grenadines">St Vincent and Grenadines</option>');
                    $('#location_visited').append('<option value="Sudan" id="Sudan">Sudan</option>');
                    $('#location_visited').append('<option value="Surinam" id="Surinam">Surinam</option>');

                    $('#location_visited').append('<option value="Swaziland" id="Swaziland">Swaziland</option>');
                    $('#location_visited').append('<option value="Sweden" id="Sweden">Sweden</option>');
                    $('#location_visited').append('<option value="Switzerland" id="Switzerland">Switzerland</option>');
                    $('#location_visited').append('<option value="Syria" id="Syria">Syria</option>');
                    $('#location_visited').append('<option value="Tajikistan" id="Tajikistan">Tajikistan</option>');

                    $('#location_visited').append('<option value="Tanzania" id="Tanzania">Tanzania</option>');
                    $('#location_visited').append('<option value="Thailand" id="Thailand">Thailand</option>');
                    $('#location_visited').append('<option value="Timor-leste" id="Timor-leste">Timor-leste</option>');
                    $('#location_visited').append('<option value="Tobago" id="Tobago">Tobago</option>');
                    $('#location_visited').append('<option value="Togo" id="Togo">Togo</option>');

                    $('#location_visited').append('<option value="Tonga" id="Tonga">Tonga</option>');
                    $('#location_visited').append('<option value="Trinidad" id="Trinidad">Trinidad</option>');
                    $('#location_visited').append('<option value="Tunisia" id="Tunisia">Tunisia</option>');
                    $('#location_visited').append('<option value="Turkey" id="Turkey">Turkey</option>');
                    $('#location_visited').append('<option value="Turkmenistan" id="Turkmenistan">Turkmenistan</option>');

                    $('#location_visited').append('<option value="Tuvalu" id="Tuvalu">Tuvalu</option>');
                    $('#location_visited').append('<option value="Uganda" id="Uganda">Uganda</option>');
                    $('#location_visited').append('<option value="Ukraine" id="Ukraine">Ukraine</option>');
                    $('#location_visited').append('<option value="United Arabs Emirates" id="United Arabs Emirates">United Arabs Emirates</option>');
                    $('#location_visited').append('<option value="Uruguay" id="Uruguay">Uruguay</option>');

                    $('#location_visited').append('<option value="USA" id="USA">USA</option>');
                    $('#location_visited').append('<option value="Uzbekistan" id="Uzbekistan">Uzbekistan</option>');
                    $('#location_visited').append('<option value="Vanuatu" id="Vanuatu">Vanuatu</option>');
                    $('#location_visited').append('<option value="Venezuela" id="Venezuela">Venezuela</option>');
                    $('#location_visited').append('<option value="Vietnam" id="Vietnam">Vietnam</option>');

                    $('#location_visited').append('<option value="Yemen" id="Yemen">Yemen</option>');
                    $('#location_visited').append('<option value="Zambia" id="Zambia">Zambia</option>');
                    $('#location_visited').append('<option value="Zimbabwe" id="Zimbabwe">Zimbabwe</option>');
                    

                } else if (selection === 'Local') {
                    displayLocal();
                }
            });

            function displayLocal() {
                var localOptions = [
                    { value: "Kilifi", text: "Kilifi" },
                    { value: "Mombasa", text: "Mombasa" },
                    { value: "Nairobi", text: "Nairobi" },
                    { value: "Turkana", text: "Turkana" },
                    { value: "West Pokot", text: "West Pokot" },
                    { value: "Samburu", text: "Samburu" },
                    { value: "Trans Nzoia", text: "Trans Nzoia" },
                    { value: "Uasin Gishu", text: "Uasin Gishu" },
                    { value: "Elgeyo-Marakwet", text: "Elgeyo-Marakwet" },
                    { value: "Nandi", text: "Nandi" },
                    { value: "Baringo", text: "Baringo" },
                    { value: "Laikipia", text: "Laikipia" },
                    { value: "Nakuru", text: "Nakuru" },
                    { value: "Narok", text: "Narok" },
                    { value: "Kajiado", text: "Kajiado" },
                    { value: "Kericho", text: "Kericho" },
                    { value: "Bomet", text: "Bomet" },
                    { value: "Kakamega", text: "Kakamega" },
                    { value: "Vihiga", text: "Vihiga" },
                    { value: "Bungoma", text: "Bungoma" },
                    { value: "Busia", text: "Busia" },
                    { value: "Siaya", text: "Siaya" },
                    { value: "Kisumu", text: "Kisumu" },
                    { value: "Homa Bay", text: "Homa Bay" },
                    { value: "Migori", text: "Migori" },
                    { value: "Kisii", text: "Kisii" },
                    { value: "Nyamira", text: "Nyamira" }
                ];

                localOptions.forEach(function(option) {
                    $('#location_visited').append('<option value="' + option.value + '" id="' + option.value + '">' + option.text + '</option>');
                });
            }

            function updateTableHeader() {        
                var fundersCurrency = "<?php echo $_SESSION['funders_currency'];?>";
        
                // Update the table header text with the selected option's value
                $('#amount-header').text('Amount (' + fundersCurrency + ')');
             
            }
            updateTableHeader(); 
            });

            
            
    </script>  
</body>
</html>